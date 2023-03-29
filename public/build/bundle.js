
(function(l, r) { if (!l || l.getElementById('livereloadscript')) return; r = l.createElement('script'); r.async = 1; r.src = '//' + (self.location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1'; r.id = 'livereloadscript'; l.getElementsByTagName('head')[0].appendChild(r) })(self.document);
var app = (function () {
    'use strict';

    function noop() { }
    function add_location(element, file, line, column, char) {
        element.__svelte_meta = {
            loc: { file, line, column, char }
        };
    }
    function run(fn) {
        return fn();
    }
    function blank_object() {
        return Object.create(null);
    }
    function run_all(fns) {
        fns.forEach(run);
    }
    function is_function(thing) {
        return typeof thing === 'function';
    }
    function safe_not_equal(a, b) {
        return a != a ? b == b : a !== b || ((a && typeof a === 'object') || typeof a === 'function');
    }
    let src_url_equal_anchor;
    function src_url_equal(element_src, url) {
        if (!src_url_equal_anchor) {
            src_url_equal_anchor = document.createElement('a');
        }
        src_url_equal_anchor.href = url;
        return element_src === src_url_equal_anchor.href;
    }
    function is_empty(obj) {
        return Object.keys(obj).length === 0;
    }
    function append(target, node) {
        target.appendChild(node);
    }
    function insert(target, node, anchor) {
        target.insertBefore(node, anchor || null);
    }
    function detach(node) {
        node.parentNode.removeChild(node);
    }
    function element(name) {
        return document.createElement(name);
    }
    function svg_element(name) {
        return document.createElementNS('http://www.w3.org/2000/svg', name);
    }
    function text(data) {
        return document.createTextNode(data);
    }
    function space() {
        return text(' ');
    }
    function attr(node, attribute, value) {
        if (value == null)
            node.removeAttribute(attribute);
        else if (node.getAttribute(attribute) !== value)
            node.setAttribute(attribute, value);
    }
    function children(element) {
        return Array.from(element.childNodes);
    }
    function custom_event(type, detail, bubbles = false) {
        const e = document.createEvent('CustomEvent');
        e.initCustomEvent(type, bubbles, false, detail);
        return e;
    }

    let current_component;
    function set_current_component(component) {
        current_component = component;
    }

    const dirty_components = [];
    const binding_callbacks = [];
    const render_callbacks = [];
    const flush_callbacks = [];
    const resolved_promise = Promise.resolve();
    let update_scheduled = false;
    function schedule_update() {
        if (!update_scheduled) {
            update_scheduled = true;
            resolved_promise.then(flush);
        }
    }
    function add_render_callback(fn) {
        render_callbacks.push(fn);
    }
    let flushing = false;
    const seen_callbacks = new Set();
    function flush() {
        if (flushing)
            return;
        flushing = true;
        do {
            // first, call beforeUpdate functions
            // and update components
            for (let i = 0; i < dirty_components.length; i += 1) {
                const component = dirty_components[i];
                set_current_component(component);
                update(component.$$);
            }
            set_current_component(null);
            dirty_components.length = 0;
            while (binding_callbacks.length)
                binding_callbacks.pop()();
            // then, once components are updated, call
            // afterUpdate functions. This may cause
            // subsequent updates...
            for (let i = 0; i < render_callbacks.length; i += 1) {
                const callback = render_callbacks[i];
                if (!seen_callbacks.has(callback)) {
                    // ...so guard against infinite loops
                    seen_callbacks.add(callback);
                    callback();
                }
            }
            render_callbacks.length = 0;
        } while (dirty_components.length);
        while (flush_callbacks.length) {
            flush_callbacks.pop()();
        }
        update_scheduled = false;
        flushing = false;
        seen_callbacks.clear();
    }
    function update($$) {
        if ($$.fragment !== null) {
            $$.update();
            run_all($$.before_update);
            const dirty = $$.dirty;
            $$.dirty = [-1];
            $$.fragment && $$.fragment.p($$.ctx, dirty);
            $$.after_update.forEach(add_render_callback);
        }
    }
    const outroing = new Set();
    let outros;
    function transition_in(block, local) {
        if (block && block.i) {
            outroing.delete(block);
            block.i(local);
        }
    }
    function transition_out(block, local, detach, callback) {
        if (block && block.o) {
            if (outroing.has(block))
                return;
            outroing.add(block);
            outros.c.push(() => {
                outroing.delete(block);
                if (callback) {
                    if (detach)
                        block.d(1);
                    callback();
                }
            });
            block.o(local);
        }
    }
    function create_component(block) {
        block && block.c();
    }
    function mount_component(component, target, anchor, customElement) {
        const { fragment, on_mount, on_destroy, after_update } = component.$$;
        fragment && fragment.m(target, anchor);
        if (!customElement) {
            // onMount happens before the initial afterUpdate
            add_render_callback(() => {
                const new_on_destroy = on_mount.map(run).filter(is_function);
                if (on_destroy) {
                    on_destroy.push(...new_on_destroy);
                }
                else {
                    // Edge case - component was destroyed immediately,
                    // most likely as a result of a binding initialising
                    run_all(new_on_destroy);
                }
                component.$$.on_mount = [];
            });
        }
        after_update.forEach(add_render_callback);
    }
    function destroy_component(component, detaching) {
        const $$ = component.$$;
        if ($$.fragment !== null) {
            run_all($$.on_destroy);
            $$.fragment && $$.fragment.d(detaching);
            // TODO null out other refs, including component.$$ (but need to
            // preserve final state?)
            $$.on_destroy = $$.fragment = null;
            $$.ctx = [];
        }
    }
    function make_dirty(component, i) {
        if (component.$$.dirty[0] === -1) {
            dirty_components.push(component);
            schedule_update();
            component.$$.dirty.fill(0);
        }
        component.$$.dirty[(i / 31) | 0] |= (1 << (i % 31));
    }
    function init(component, options, instance, create_fragment, not_equal, props, append_styles, dirty = [-1]) {
        const parent_component = current_component;
        set_current_component(component);
        const $$ = component.$$ = {
            fragment: null,
            ctx: null,
            // state
            props,
            update: noop,
            not_equal,
            bound: blank_object(),
            // lifecycle
            on_mount: [],
            on_destroy: [],
            on_disconnect: [],
            before_update: [],
            after_update: [],
            context: new Map(parent_component ? parent_component.$$.context : options.context || []),
            // everything else
            callbacks: blank_object(),
            dirty,
            skip_bound: false,
            root: options.target || parent_component.$$.root
        };
        append_styles && append_styles($$.root);
        let ready = false;
        $$.ctx = instance
            ? instance(component, options.props || {}, (i, ret, ...rest) => {
                const value = rest.length ? rest[0] : ret;
                if ($$.ctx && not_equal($$.ctx[i], $$.ctx[i] = value)) {
                    if (!$$.skip_bound && $$.bound[i])
                        $$.bound[i](value);
                    if (ready)
                        make_dirty(component, i);
                }
                return ret;
            })
            : [];
        $$.update();
        ready = true;
        run_all($$.before_update);
        // `false` as a special case of no DOM component
        $$.fragment = create_fragment ? create_fragment($$.ctx) : false;
        if (options.target) {
            if (options.hydrate) {
                const nodes = children(options.target);
                // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
                $$.fragment && $$.fragment.l(nodes);
                nodes.forEach(detach);
            }
            else {
                // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
                $$.fragment && $$.fragment.c();
            }
            if (options.intro)
                transition_in(component.$$.fragment);
            mount_component(component, options.target, options.anchor, options.customElement);
            flush();
        }
        set_current_component(parent_component);
    }
    /**
     * Base class for Svelte components. Used when dev=false.
     */
    class SvelteComponent {
        $destroy() {
            destroy_component(this, 1);
            this.$destroy = noop;
        }
        $on(type, callback) {
            const callbacks = (this.$$.callbacks[type] || (this.$$.callbacks[type] = []));
            callbacks.push(callback);
            return () => {
                const index = callbacks.indexOf(callback);
                if (index !== -1)
                    callbacks.splice(index, 1);
            };
        }
        $set($$props) {
            if (this.$$set && !is_empty($$props)) {
                this.$$.skip_bound = true;
                this.$$set($$props);
                this.$$.skip_bound = false;
            }
        }
    }

    function dispatch_dev(type, detail) {
        document.dispatchEvent(custom_event(type, Object.assign({ version: '3.42.1' }, detail), true));
    }
    function append_dev(target, node) {
        dispatch_dev('SvelteDOMInsert', { target, node });
        append(target, node);
    }
    function insert_dev(target, node, anchor) {
        dispatch_dev('SvelteDOMInsert', { target, node, anchor });
        insert(target, node, anchor);
    }
    function detach_dev(node) {
        dispatch_dev('SvelteDOMRemove', { node });
        detach(node);
    }
    function attr_dev(node, attribute, value) {
        attr(node, attribute, value);
        if (value == null)
            dispatch_dev('SvelteDOMRemoveAttribute', { node, attribute });
        else
            dispatch_dev('SvelteDOMSetAttribute', { node, attribute, value });
    }
    function validate_slots(name, slot, keys) {
        for (const slot_key of Object.keys(slot)) {
            if (!~keys.indexOf(slot_key)) {
                console.warn(`<${name}> received an unexpected slot "${slot_key}".`);
            }
        }
    }
    /**
     * Base class for Svelte components with some minor dev-enhancements. Used when dev=true.
     */
    class SvelteComponentDev extends SvelteComponent {
        constructor(options) {
            if (!options || (!options.target && !options.$$inline)) {
                throw new Error("'target' is a required option");
            }
            super();
        }
        $destroy() {
            super.$destroy();
            this.$destroy = () => {
                console.warn('Component was already destroyed'); // eslint-disable-line no-console
            };
        }
        $capture_state() { }
        $inject_state() { }
    }

    /* src\components\Header.svelte generated by Svelte v3.42.1 */

    const file$2 = "src\\components\\Header.svelte";

    function create_fragment$2(ctx) {
    	let header;
    	let nav;
    	let div2;
    	let a0;
    	let img;
    	let img_src_value;
    	let t0;
    	let span0;
    	let t2;
    	let div0;
    	let a1;
    	let t4;
    	let a2;
    	let t6;
    	let button;
    	let span1;
    	let t8;
    	let svg0;
    	let path0;
    	let t9;
    	let svg1;
    	let path1;
    	let t10;
    	let div1;
    	let ul;
    	let li0;
    	let a3;
    	let t12;
    	let li1;
    	let a4;
    	let t14;
    	let li2;
    	let a5;
    	let t16;
    	let li3;
    	let a6;
    	let t18;
    	let li4;
    	let a7;
    	let t20;
    	let li5;
    	let a8;

    	const block = {
    		c: function create() {
    			header = element("header");
    			nav = element("nav");
    			div2 = element("div");
    			a0 = element("a");
    			img = element("img");
    			t0 = space();
    			span0 = element("span");
    			span0.textContent = "Flowbite";
    			t2 = space();
    			div0 = element("div");
    			a1 = element("a");
    			a1.textContent = "Log in";
    			t4 = space();
    			a2 = element("a");
    			a2.textContent = "Get started";
    			t6 = space();
    			button = element("button");
    			span1 = element("span");
    			span1.textContent = "Open main menu";
    			t8 = space();
    			svg0 = svg_element("svg");
    			path0 = svg_element("path");
    			t9 = space();
    			svg1 = svg_element("svg");
    			path1 = svg_element("path");
    			t10 = space();
    			div1 = element("div");
    			ul = element("ul");
    			li0 = element("li");
    			a3 = element("a");
    			a3.textContent = "Home";
    			t12 = space();
    			li1 = element("li");
    			a4 = element("a");
    			a4.textContent = "Company";
    			t14 = space();
    			li2 = element("li");
    			a5 = element("a");
    			a5.textContent = "Marketplace";
    			t16 = space();
    			li3 = element("li");
    			a6 = element("a");
    			a6.textContent = "Features";
    			t18 = space();
    			li4 = element("li");
    			a7 = element("a");
    			a7.textContent = "Team";
    			t20 = space();
    			li5 = element("li");
    			a8 = element("a");
    			a8.textContent = "Contact";
    			if (!src_url_equal(img.src, img_src_value = "https://flowbite.com/docs/images/logo.svg")) attr_dev(img, "src", img_src_value);
    			attr_dev(img, "class", "mr-3 h-6 sm:h-9");
    			attr_dev(img, "alt", "Flowbite Logo");
    			add_location(img, file$2, 6, 20, 274);
    			attr_dev(span0, "class", "self-center text-xl font-semibold whitespace-nowrap dark:text-white");
    			add_location(span0, file$2, 7, 20, 395);
    			attr_dev(a0, "href", "#");
    			attr_dev(a0, "class", "flex items-center");
    			add_location(a0, file$2, 5, 16, 214);
    			attr_dev(a1, "href", "#");
    			attr_dev(a1, "class", "text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800");
    			add_location(a1, file$2, 10, 20, 596);
    			attr_dev(a2, "href", "#");
    			attr_dev(a2, "class", "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800");
    			add_location(a2, file$2, 11, 20, 859);
    			attr_dev(span1, "class", "sr-only");
    			add_location(span1, file$2, 13, 24, 1497);
    			attr_dev(path0, "fill-rule", "evenodd");
    			attr_dev(path0, "d", "M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z");
    			attr_dev(path0, "clip-rule", "evenodd");
    			add_location(path0, file$2, 14, 120, 1662);
    			attr_dev(svg0, "class", "w-6 h-6");
    			attr_dev(svg0, "fill", "currentColor");
    			attr_dev(svg0, "viewBox", "0 0 20 20");
    			attr_dev(svg0, "xmlns", "http://www.w3.org/2000/svg");
    			add_location(svg0, file$2, 14, 24, 1566);
    			attr_dev(path1, "fill-rule", "evenodd");
    			attr_dev(path1, "d", "M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z");
    			attr_dev(path1, "clip-rule", "evenodd");
    			add_location(path1, file$2, 15, 127, 1998);
    			attr_dev(svg1, "class", "hidden w-6 h-6");
    			attr_dev(svg1, "fill", "currentColor");
    			attr_dev(svg1, "viewBox", "0 0 20 20");
    			attr_dev(svg1, "xmlns", "http://www.w3.org/2000/svg");
    			add_location(svg1, file$2, 15, 24, 1895);
    			attr_dev(button, "data-collapse-toggle", "mobile-menu-2");
    			attr_dev(button, "type", "button");
    			attr_dev(button, "class", "inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600");
    			attr_dev(button, "aria-controls", "mobile-menu-2");
    			attr_dev(button, "aria-expanded", "false");
    			add_location(button, file$2, 12, 20, 1138);
    			attr_dev(div0, "class", "flex items-center lg:order-2");
    			add_location(div0, file$2, 9, 16, 532);
    			attr_dev(a3, "href", "#");
    			attr_dev(a3, "class", "block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white");
    			attr_dev(a3, "aria-current", "page");
    			add_location(a3, file$2, 21, 28, 2591);
    			add_location(li0, file$2, 20, 24, 2557);
    			attr_dev(a4, "href", "#");
    			attr_dev(a4, "class", "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700");
    			add_location(a4, file$2, 24, 28, 2840);
    			add_location(li1, file$2, 23, 24, 2806);
    			attr_dev(a5, "href", "#");
    			attr_dev(a5, "class", "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700");
    			add_location(a5, file$2, 27, 28, 3244);
    			add_location(li2, file$2, 26, 24, 3210);
    			attr_dev(a6, "href", "#");
    			attr_dev(a6, "class", "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700");
    			add_location(a6, file$2, 30, 28, 3652);
    			add_location(li3, file$2, 29, 24, 3618);
    			attr_dev(a7, "href", "#");
    			attr_dev(a7, "class", "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700");
    			add_location(a7, file$2, 33, 28, 4057);
    			add_location(li4, file$2, 32, 24, 4023);
    			attr_dev(a8, "href", "#");
    			attr_dev(a8, "class", "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700");
    			add_location(a8, file$2, 36, 28, 4458);
    			add_location(li5, file$2, 35, 24, 4424);
    			attr_dev(ul, "class", "flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0");
    			add_location(ul, file$2, 19, 20, 2455);
    			attr_dev(div1, "class", "hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1");
    			attr_dev(div1, "id", "mobile-menu-2");
    			add_location(div1, file$2, 18, 16, 2329);
    			attr_dev(div2, "class", "flex flex-wrap justify-between items-center mx-auto max-w-screen-xl");
    			add_location(div2, file$2, 4, 12, 115);
    			attr_dev(nav, "class", "bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800");
    			add_location(nav, file$2, 3, 8, 26);
    			add_location(header, file$2, 2, 4, 8);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, header, anchor);
    			append_dev(header, nav);
    			append_dev(nav, div2);
    			append_dev(div2, a0);
    			append_dev(a0, img);
    			append_dev(a0, t0);
    			append_dev(a0, span0);
    			append_dev(div2, t2);
    			append_dev(div2, div0);
    			append_dev(div0, a1);
    			append_dev(div0, t4);
    			append_dev(div0, a2);
    			append_dev(div0, t6);
    			append_dev(div0, button);
    			append_dev(button, span1);
    			append_dev(button, t8);
    			append_dev(button, svg0);
    			append_dev(svg0, path0);
    			append_dev(button, t9);
    			append_dev(button, svg1);
    			append_dev(svg1, path1);
    			append_dev(div2, t10);
    			append_dev(div2, div1);
    			append_dev(div1, ul);
    			append_dev(ul, li0);
    			append_dev(li0, a3);
    			append_dev(ul, t12);
    			append_dev(ul, li1);
    			append_dev(li1, a4);
    			append_dev(ul, t14);
    			append_dev(ul, li2);
    			append_dev(li2, a5);
    			append_dev(ul, t16);
    			append_dev(ul, li3);
    			append_dev(li3, a6);
    			append_dev(ul, t18);
    			append_dev(ul, li4);
    			append_dev(li4, a7);
    			append_dev(ul, t20);
    			append_dev(ul, li5);
    			append_dev(li5, a8);
    		},
    		p: noop,
    		i: noop,
    		o: noop,
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(header);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment$2.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function instance$2($$self, $$props) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('Header', slots, []);
    	const writable_props = [];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<Header> was created with unknown prop '${key}'`);
    	});

    	return [];
    }

    class Header extends SvelteComponentDev {
    	constructor(options) {
    		super(options);
    		init(this, options, instance$2, create_fragment$2, safe_not_equal, {});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "Header",
    			options,
    			id: create_fragment$2.name
    		});
    	}
    }

    /* src\components\Sidebar.svelte generated by Svelte v3.42.1 */

    const file$1 = "src\\components\\Sidebar.svelte";

    function create_fragment$1(ctx) {
    	let div;
    	let nav;
    	let a0;
    	let svg0;
    	let path0;
    	let t0;
    	let small0;
    	let t2;
    	let a1;
    	let svg1;
    	let path1;
    	let t3;
    	let small1;
    	let t5;
    	let a2;
    	let svg2;
    	let path2;
    	let path3;
    	let t6;
    	let small2;
    	let t8;
    	let hr;
    	let t9;
    	let a3;
    	let svg3;
    	let path4;
    	let t10;
    	let small3;

    	const block = {
    		c: function create() {
    			div = element("div");
    			nav = element("nav");
    			a0 = element("a");
    			svg0 = svg_element("svg");
    			path0 = svg_element("path");
    			t0 = space();
    			small0 = element("small");
    			small0.textContent = "Profile";
    			t2 = space();
    			a1 = element("a");
    			svg1 = svg_element("svg");
    			path1 = svg_element("path");
    			t3 = space();
    			small1 = element("small");
    			small1.textContent = "Analytics";
    			t5 = space();
    			a2 = element("a");
    			svg2 = svg_element("svg");
    			path2 = svg_element("path");
    			path3 = svg_element("path");
    			t6 = space();
    			small2 = element("small");
    			small2.textContent = "Settings";
    			t8 = space();
    			hr = element("hr");
    			t9 = space();
    			a3 = element("a");
    			svg3 = svg_element("svg");
    			path4 = svg_element("path");
    			t10 = space();
    			small3 = element("small");
    			small3.textContent = "Home";
    			attr_dev(path0, "stroke-linecap", "round");
    			attr_dev(path0, "stroke-linejoin", "round");
    			attr_dev(path0, "d", "M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z");
    			add_location(path0, file$1, 26, 8, 6843);
    			attr_dev(svg0, "xmlns", "http://www.w3.org/2000/svg");
    			attr_dev(svg0, "fill", "none");
    			attr_dev(svg0, "viewBox", "0 0 24 24");
    			attr_dev(svg0, "stroke-width", "1.5");
    			attr_dev(svg0, "stroke", "currentColor");
    			attr_dev(svg0, "class", "w-6 h-6 shrink-0");
    			add_location(svg0, file$1, 18, 8, 6631);
    			attr_dev(small0, "class", "text-center text-xs font-medium");
    			add_location(small0, file$1, 33, 8, 7123);
    			attr_dev(a0, "href", "#profile");
    			attr_dev(a0, "class", "flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 bg-indigo-50 text-indigo-600 dark:bg-sky-900 dark:text-sky-50");
    			add_location(a0, file$1, 13, 4, 6377);
    			attr_dev(path1, "stroke-linecap", "round");
    			attr_dev(path1, "stroke-linejoin", "round");
    			attr_dev(path1, "d", "M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z");
    			add_location(path1, file$1, 49, 8, 7691);
    			attr_dev(svg1, "xmlns", "http://www.w3.org/2000/svg");
    			attr_dev(svg1, "fill", "none");
    			attr_dev(svg1, "viewBox", "0 0 24 24");
    			attr_dev(svg1, "stroke-width", "1.5");
    			attr_dev(svg1, "stroke", "currentColor");
    			attr_dev(svg1, "class", "w-6 h-6 shrink-0");
    			add_location(svg1, file$1, 41, 8, 7479);
    			attr_dev(small1, "class", "text-center text-xs font-medium");
    			add_location(small1, file$1, 56, 8, 8271);
    			attr_dev(a1, "href", "#analytics");
    			attr_dev(a1, "class", "flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800");
    			add_location(a1, file$1, 36, 4, 7205);
    			attr_dev(path2, "stroke-linecap", "round");
    			attr_dev(path2, "stroke-linejoin", "round");
    			attr_dev(path2, "d", "M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z");
    			add_location(path2, file$1, 72, 8, 8838);
    			attr_dev(path3, "stroke-linecap", "round");
    			attr_dev(path3, "stroke-linejoin", "round");
    			attr_dev(path3, "d", "M15 12a3 3 0 11-6 0 3 3 0 016 0z");
    			add_location(path3, file$1, 77, 8, 9938);
    			attr_dev(svg2, "xmlns", "http://www.w3.org/2000/svg");
    			attr_dev(svg2, "fill", "none");
    			attr_dev(svg2, "viewBox", "0 0 24 24");
    			attr_dev(svg2, "stroke-width", "1.5");
    			attr_dev(svg2, "stroke", "currentColor");
    			attr_dev(svg2, "class", "w-6 h-6 shrink-0");
    			add_location(svg2, file$1, 64, 8, 8626);
    			attr_dev(small2, "class", "text-center text-xs font-medium");
    			add_location(small2, file$1, 84, 8, 10106);
    			attr_dev(a2, "href", "#settings");
    			attr_dev(a2, "class", "flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800");
    			add_location(a2, file$1, 59, 4, 8355);
    			attr_dev(hr, "class", "dark:border-gray-700/60");
    			add_location(hr, file$1, 87, 4, 10189);
    			attr_dev(path4, "stroke-linecap", "round");
    			attr_dev(path4, "stroke-linejoin", "round");
    			attr_dev(path4, "d", "M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819");
    			add_location(path4, file$1, 102, 8, 10623);
    			attr_dev(svg3, "xmlns", "http://www.w3.org/2000/svg");
    			attr_dev(svg3, "fill", "none");
    			attr_dev(svg3, "viewBox", "0 0 24 24");
    			attr_dev(svg3, "stroke-width", "1.5");
    			attr_dev(svg3, "stroke", "currentColor");
    			attr_dev(svg3, "class", "w-6 h-6");
    			add_location(svg3, file$1, 94, 8, 10420);
    			attr_dev(small3, "class", "text-xs font-medium");
    			add_location(small3, file$1, 109, 8, 10993);
    			attr_dev(a3, "href", "/");
    			attr_dev(a3, "class", "flex h-16 w-16 flex-col items-center justify-center gap-1 text-fuchsia-900 dark:text-gray-400");
    			add_location(a3, file$1, 89, 4, 10235);
    			attr_dev(nav, "class", "z-20 flex shrink-0 grow-0 justify-around gap-4 border-t border-gray-200 bg-white/50 p-2.5 shadow-lg backdrop-blur-lg dark:border-slate-600/60 dark:bg-slate-800/50 fixed top-2/4 -translate-y-2/4 left-6 min-h-[auto] min-w-[64px] flex-col rounded-lg border");
    			add_location(nav, file$1, 10, 4, 6093);
    			attr_dev(div, "class", "relative bg-gray-50 dark:bg-slate-900 w-screen h-screen pattern svelte-2kvjb0");
    			add_location(div, file$1, 7, 0, 6003);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div, anchor);
    			append_dev(div, nav);
    			append_dev(nav, a0);
    			append_dev(a0, svg0);
    			append_dev(svg0, path0);
    			append_dev(a0, t0);
    			append_dev(a0, small0);
    			append_dev(nav, t2);
    			append_dev(nav, a1);
    			append_dev(a1, svg1);
    			append_dev(svg1, path1);
    			append_dev(a1, t3);
    			append_dev(a1, small1);
    			append_dev(nav, t5);
    			append_dev(nav, a2);
    			append_dev(a2, svg2);
    			append_dev(svg2, path2);
    			append_dev(svg2, path3);
    			append_dev(a2, t6);
    			append_dev(a2, small2);
    			append_dev(nav, t8);
    			append_dev(nav, hr);
    			append_dev(nav, t9);
    			append_dev(nav, a3);
    			append_dev(a3, svg3);
    			append_dev(svg3, path4);
    			append_dev(a3, t10);
    			append_dev(a3, small3);
    		},
    		p: noop,
    		i: noop,
    		o: noop,
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment$1.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function instance$1($$self, $$props) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('Sidebar', slots, []);
    	const writable_props = [];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<Sidebar> was created with unknown prop '${key}'`);
    	});

    	return [];
    }

    class Sidebar extends SvelteComponentDev {
    	constructor(options) {
    		super(options);
    		init(this, options, instance$1, create_fragment$1, safe_not_equal, {});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "Sidebar",
    			options,
    			id: create_fragment$1.name
    		});
    	}
    }

    /* src\App.svelte generated by Svelte v3.42.1 */
    const file = "src\\App.svelte";

    function create_fragment(ctx) {
    	let main;
    	let header;
    	let t;
    	let sidebar;
    	let current;
    	header = new Header({ $$inline: true });
    	sidebar = new Sidebar({ $$inline: true });

    	const block = {
    		c: function create() {
    			main = element("main");
    			create_component(header.$$.fragment);
    			t = space();
    			create_component(sidebar.$$.fragment);
    			add_location(main, file, 6, 0, 133);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, main, anchor);
    			mount_component(header, main, null);
    			append_dev(main, t);
    			mount_component(sidebar, main, null);
    			current = true;
    		},
    		p: noop,
    		i: function intro(local) {
    			if (current) return;
    			transition_in(header.$$.fragment, local);
    			transition_in(sidebar.$$.fragment, local);
    			current = true;
    		},
    		o: function outro(local) {
    			transition_out(header.$$.fragment, local);
    			transition_out(sidebar.$$.fragment, local);
    			current = false;
    		},
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(main);
    			destroy_component(header);
    			destroy_component(sidebar);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function instance($$self, $$props, $$invalidate) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('App', slots, []);
    	const writable_props = [];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<App> was created with unknown prop '${key}'`);
    	});

    	$$self.$capture_state = () => ({ Header, Sidebar });
    	return [];
    }

    class App extends SvelteComponentDev {
    	constructor(options) {
    		super(options);
    		init(this, options, instance, create_fragment, safe_not_equal, {});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "App",
    			options,
    			id: create_fragment.name
    		});
    	}
    }

    const app = new App({
    	target: document.body,
    	props: {}
    });

    return app;

}());
//# sourceMappingURL=bundle.js.map
