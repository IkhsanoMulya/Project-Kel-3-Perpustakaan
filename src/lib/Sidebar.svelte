<script>
	import { Dropdown, DropdownItem } from 'flowbite-svelte';
</script>

<div class="">
	<div class="relative bg-gray-50 dark:bg-slate-900 h-screen pattern">
		<nav
			class="z-20 flex shrink-0 grow-0 justify-around gap-2.5 border-t border-gray-200 bg-white/50 p-4 shadow-lg backdrop-blur-lg dark:border-slate-600/60 dark:bg-slate-800/50 fixed top-2/4 -translate-y-2/4 left-6 min-h-[auto] min-w-[64px] flex-col rounded-lg border"
		>
			<a
				href="/"
				class="flex h-17 w-17 flex-col items-center justify-center gap-1 rounded-md hover:bg-blue-300 dark:text-gray-400"
			>
				<!-- HeroIcon - Home Modern -->
				<svg
					version="1.1"
					id="Layer_1"
					xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink"
					viewBox="0 0 506 506"
					xml:space="preserve"
					fill="#000000"
					transform="matrix(1, 0, 0, -1, 0, 0)"
				>
					<g id="SVGRepo_bgCarrier" stroke-width="0" />
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
					<g id="SVGRepo_iconCarrier">
						<circle style="fill:#90E0EF;" cx="253" cy="253" r="253" />
						<path
							style="fill:#F2FF49;"
							d="M187.6,359.1c-22.8,0-41-18.3-40.9-40.9c-0.1-22.5,18.1-40.9,40.9-40.9c75.2,0,150.3,0,225.5,0v-15.8 H149.6c-31.3,0-56.7,25.4-56.7,56.7s25.4,56.7,56.7,56.7h263.5v-15.8C337.9,359.1,262.8,359.1,187.6,359.1z"
						/>
						<path
							style="fill:#E6E9EE;"
							d="M149.6,359.1c-22.8,0-41-18.3-40.9-40.9c-0.1-22.5,18.1-40.9,40.9-40.9c87.8,0,175.7,0,263.5,0 c-10.8,26.2-10.8,55.6,0,81.8C325.3,359.1,237.4,359.1,149.6,359.1z"
						/>
						<path
							style="fill:#FF6B6B;"
							d="M318.4,146.9c22.8,0,41,18.3,40.9,40.9c0.1,22.5-18.1,40.9-40.9,40.9c-75.2,0-150.3,0-225.5,0v15.8 h263.5c31.3,0,56.7-25.4,56.7-56.7s-25.4-56.7-56.7-56.7H92.9v15.8C168.1,146.9,243.2,146.9,318.4,146.9z"
						/>
						<path
							style="fill:#E6E9EE;"
							d="M356.4,146.9c22.8,0,41,18.3,40.9,40.9c0.1,22.5-18.1,40.9-40.9,40.9c-87.8,0-175.7,0-263.5,0 c10.8-26.2,10.8-55.6,0-81.8C180.7,146.9,268.6,146.9,356.4,146.9z"
						/>
					</g>
				</svg>

				<small class="text-sm font-medium">Scientia</small>
			</a>

			<hr class="dark:border-gray-700/60" />
			<a
				href="/"
				class="flex h-16 w-16 flex-col items-center current-link justify-center rounded-md gap-1 hover:bg-blue-300 dark:text-gray-400"
			>
				<!-- HeroIcon - Home Modern -->
				<svg
					xmlns="http://www.w3.org/2000/svg"
					fill="none"
					viewBox="0 0 24 24"
					stroke-width="1.5"
					stroke="currentColor"
					class="w-6 h-6"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"
					/>
				</svg>

				<small class="text-xs font-medium">Home</small>
			</a>

			<a
				href="/peminjaman"
				class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md hover:bg-blue-300 p-1.5 dark:bg-sky-900 dark:text-sky-50"
			>
				<!-- HeroIcon - User -->
				<svg
					fill="#000000"
					version="1.1"
					id="Layer_1"
					xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink"
					viewBox="0 0 512 512"
					xml:space="preserve"
				>
					<g>
						<g>
							<path
								d="M213.244,102.614H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S217.672,102.614,213.244,102.614z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M213.244,171.023H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S217.672,171.023,213.244,171.023z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M213.244,239.432H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S217.672,239.432,213.244,239.432z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M213.244,307.841H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S217.672,307.841,213.244,307.841z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M119.182,136.818H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.205
			c4.427,0,8.017-3.589,8.017-8.017S123.609,136.818,119.182,136.818z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M119.182,342.046H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.205
			c4.427,0,8.017-3.589,8.017-8.017S123.609,342.046,119.182,342.046z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M213.244,342.046h-59.858c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h59.858
			c4.427,0,8.017-3.589,8.017-8.017S217.672,342.046,213.244,342.046z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,342.046h-59.858c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h59.858
			c4.427,0,8.017-3.589,8.017-8.017S431.45,342.046,427.023,342.046z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M213.244,273.637H179.04c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.205
			c4.427,0,8.017-3.589,8.017-8.017S217.672,273.637,213.244,273.637z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M144.835,273.637H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h59.858
			c4.427,0,8.017-3.589,8.017-8.017S149.262,273.637,144.835,273.637z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M136.284,205.228H84.977c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h51.307
			c4.427,0,8.017-3.589,8.017-8.017S140.711,205.228,136.284,205.228z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M213.244,205.228h-42.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h42.756
			c4.427,0,8.017-3.589,8.017-8.017S217.672,205.228,213.244,205.228z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M213.244,136.818h-59.858c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h59.858
			c4.427,0,8.017-3.589,8.017-8.017S217.672,136.818,213.244,136.818z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,102.614H298.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S431.45,102.614,427.023,102.614z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,171.023H298.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S431.45,171.023,427.023,171.023z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,239.432H298.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S431.45,239.432,427.023,239.432z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,307.841H298.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h128.267
			c4.427,0,8.017-3.589,8.017-8.017S431.45,307.841,427.023,307.841z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M332.96,136.818h-34.205c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.205
			c4.427,0,8.017-3.589,8.017-8.017S337.388,136.818,332.96,136.818z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M332.96,342.046h-34.205c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.205
			c4.427,0,8.017-3.589,8.017-8.017S337.388,342.046,332.96,342.046z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,273.637h-34.205c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.205
			c4.427,0,8.017-3.589,8.017-8.017S431.45,273.637,427.023,273.637z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M358.614,273.637h-59.858c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h59.858
			c4.427,0,8.017-3.589,8.017-8.017S363.041,273.637,358.614,273.637z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M350.063,205.228h-51.307c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h51.307
			c4.427,0,8.017-3.589,8.017-8.017S354.49,205.228,350.063,205.228z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,205.228h-42.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h42.756
			c4.427,0,8.017-3.589,8.017-8.017S431.45,205.228,427.023,205.228z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M427.023,136.818h-59.858c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h59.858
			c4.427,0,8.017-3.589,8.017-8.017S431.45,136.818,427.023,136.818z"
							/>
						</g>
					</g>
					<g>
						<g>
							<path
								d="M486.881,85.511h-9.086V59.324c0-4.427-3.589-8.017-8.017-8.017H281.653c-10.269,0-19.472,4.626-25.653,11.898
			c-6.181-7.272-15.385-11.898-25.653-11.898H42.221c-4.427,0-8.017,3.589-8.017,8.017v26.188h-9.086
			C11.268,85.511,0,96.78,0,110.63v316.392c0,13.851,11.268,25.119,25.119,25.119h190.739c2.829,5.093,8.26,8.551,14.489,8.551
			h51.307c6.228,0,11.659-3.458,14.489-8.551h190.739c13.851,0,25.119-11.268,25.119-25.119V110.63
			C512,96.78,500.732,85.511,486.881,85.511z M213.779,436.109H25.119c-5.01,0-9.086-4.076-9.086-9.086V110.63
			c0-5.01,4.076-9.086,9.086-9.086h9.086v308.376c0,4.427,3.589,8.017,8.017,8.017h171.557V436.109z M50.238,401.904V93.539
			c0-0.003,0-0.006,0-0.011s0-0.006,0-0.011V67.34h180.109c9.725,0,17.637,7.912,17.637,17.637v316.927H50.238z M282.188,444.125
			c0,0.295-0.239,0.534-0.534,0.534h-51.307c-0.295,0-0.534-0.239-0.534-0.534v-26.188H256h26.188V444.125z M264.017,401.904V84.977
			c0-9.725,7.912-17.637,17.637-17.637h180.109v334.564H264.017z M495.967,427.023c0,5.01-4.076,9.086-9.086,9.086h-188.66v-18.171
			h171.557c4.427,0,8.017-3.589,8.017-8.017V101.545h9.086c5.01,0,9.086,4.076,9.086,9.086V427.023z"
							/>
						</g>
					</g>
				</svg>

				<small class="text-center text-xs font-medium">Peminjaman</small>
			</a>

			<a
				href="/pengembalian"
				class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 text-gray-700 hover:bg-blue-300 dark:text-gray-400 dark:hover:bg-slate-800"
			>
				<!-- HeroIcon - Chart Bar -->
				<svg
					fill="#000000"
					viewBox="0 0 32 32"
					version="1.1"
					xmlns="http://www.w3.org/2000/svg"
				>
					<title>book-bookmark</title>
					<path
						d="M27.75 2c-0-0.414-0.336-0.75-0.75-0.75h-4.963c-0.020-0.002-0.037-0.012-0.058-0.012h-7.957c-0.021 0-0.038 0.010-0.058 0.012h-6.763c-0.028-0.001-0.061-0.002-0.094-0.002-1.541 0-2.797 1.22-2.856 2.746l-0 0.005v24.389c0.113 1.331 1.221 2.367 2.572 2.367 0.063 0 0.125-0.002 0.187-0.007l-0.008 0h20c0.414 0 0.75-0.336 0.75-0.75s-0.336-0.75-0.75-0.75v0h-19.8c-0.023 0.001-0.050 0.002-0.077 0.002-0.717 0-1.306-0.547-1.373-1.247l-0-0.006v-1.223c0-0.459 0.584-0.861 1.248-0.861l20.002 0.057c0 0 0.001 0 0.001 0 0.207 0 0.394-0.084 0.529-0.22l0-0c0.017-0.017 0.025-0.041 0.040-0.060 0.047-0.051 0.087-0.11 0.118-0.173l0.002-0.004c0.016-0.049 0.029-0.105 0.034-0.164l0-0.003c0.011-0.035 0.020-0.077 0.025-0.121l0-0.003v-0.002zM26.25 24.471l-15.5-0.044v-21.677h2.521v10.448c0 0 0 0 0 0.001 0 0.414 0.336 0.749 0.749 0.749 0.181 0 0.347-0.064 0.476-0.171l-0.001 0.001 3.51-2.869 3.504 2.804c0.127 0.102 0.29 0.164 0.468 0.164 0.414 0 0.75-0.336 0.751-0.75v-10.377h3.521zM21.229 2.75v8.816l-2.76-2.208c-0.127-0.103-0.29-0.165-0.468-0.165-0.181 0-0.347 0.064-0.477 0.172l0.001-0.001-2.754 2.252v-8.866zM5.75 24.686v-20.686c0.067-0.705 0.657-1.252 1.374-1.252 0.027 0 0.054 0.001 0.080 0.002l-0.004-0h2.050v21.672l-2.25-0.006c-0.453 0.002-0.883 0.101-1.269 0.278l0.019-0.008z"
					/>
				</svg>

				<small class="text-center text-xs font-medium">Pengembalian</small>
			</a>

			<a
				href="/buku"
				class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 text-gray-700 hover:bg-blue-300 dark:text-gray-400 dark:hover:bg-slate-800"
			>
				<!-- HeroIcon - Cog-6-tooth -->

				<svg
					fill="#000000"
					viewBox="0 0 50 50"
					xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink"
				>
					<path
						d="M7.8125 3C7.335938 3.089844 6.992188 3.511719 7 4L7 31L3 31C2.96875 31 2.9375 31 2.90625 31C2.390625 31.046875 1.996094 31.480469 2 32L2 36C2 36.550781 2.449219 37 3 37L6 37L6 44.5C6 45.867188 7.132813 47 8.5 47C9.867188 47 11 45.867188 11 44.5L11 37L39 37L39 44.5C39 45.867188 40.132813 47 41.5 47C42.867188 47 44 45.867188 44 44.5L44 37L47 37C47.550781 37 48 36.550781 48 36L48 32C48 31.449219 47.550781 31 47 31L43.875 31C43.902344 30.867188 43.902344 30.726563 43.875 30.59375L38.8125 9.1875C38.703125 8.671875 38.210938 8.328125 37.6875 8.40625C37.667969 8.414063 37.644531 8.425781 37.625 8.4375L32.75 9.59375C32.378906 9.679688 32.085938 9.972656 32 10.34375L32 10C32 9.449219 31.550781 9 31 9L25 9L25 4C25 3.449219 24.550781 3 24 3L16.0625 3C16.042969 3 16.019531 3 16 3L8 3C7.96875 3 7.9375 3 7.90625 3C7.875 3 7.84375 3 7.8125 3 Z M 9 5L15 5L15 31L9 31 Z M 17 5L23 5L23 9.90625C23 9.9375 23 9.96875 23 10L23 31L17 31 Z M 10.71875 7C10.167969 7.078125 9.78125 7.589844 9.859375 8.140625C9.9375 8.691406 10.449219 9.078125 11 9L13 9C13.359375 9.003906 13.695313 8.816406 13.878906 8.503906C14.058594 8.191406 14.058594 7.808594 13.878906 7.496094C13.695313 7.183594 13.359375 6.996094 13 7L11 7C10.96875 7 10.9375 7 10.90625 7C10.875 7 10.84375 7 10.8125 7C10.78125 7 10.75 7 10.71875 7 Z M 18.71875 7C18.167969 7.078125 17.78125 7.589844 17.859375 8.140625C17.9375 8.691406 18.449219 9.078125 19 9L21 9C21.359375 9.003906 21.695313 8.816406 21.878906 8.503906C22.058594 8.191406 22.058594 7.808594 21.878906 7.496094C21.695313 7.183594 21.359375 6.996094 21 7L19 7C18.96875 7 18.9375 7 18.90625 7C18.875 7 18.84375 7 18.8125 7C18.78125 7 18.75 7 18.71875 7 Z M 37.09375 10.59375L37.71875 13.28125C37.507813 12.902344 37.082031 12.703125 36.65625 12.78125C36.625 12.789063 36.59375 12.800781 36.5625 12.8125L35.59375 13.03125C35.1875 13.101563 34.867188 13.410156 34.78125 13.8125L34.1875 11.28125 Z M 32 10.78125L36.78125 31L32 31 Z M 25 11L30 11L30 31L25 31 Z M 26.71875 13C26.167969 13.078125 25.78125 13.589844 25.859375 14.140625C25.9375 14.691406 26.449219 15.078125 27 15L28 15C28.359375 15.003906 28.695313 14.816406 28.878906 14.503906C29.058594 14.191406 29.058594 13.808594 28.878906 13.496094C28.695313 13.183594 28.359375 12.996094 28 13L27 13C26.96875 13 26.9375 13 26.90625 13C26.875 13 26.84375 13 26.8125 13C26.78125 13 26.75 13 26.71875 13 Z M 37.84375 13.84375L40.875 26.6875C40.652344 26.445313 40.324219 26.332031 40 26.375C39.945313 26.382813 39.894531 26.390625 39.84375 26.40625C39.824219 26.414063 39.800781 26.425781 39.78125 26.4375L38.8125 26.65625C38.40625 26.726563 38.085938 27.035156 38 27.4375L35 14.6875C35.265625 14.984375 35.683594 15.09375 36.0625 14.96875L37.03125 14.75C37.476563 14.664063 37.808594 14.292969 37.84375 13.84375 Z M 10.71875 27C10.167969 27.078125 9.78125 27.589844 9.859375 28.140625C9.9375 28.691406 10.449219 29.078125 11 29L13 29C13.359375 29.003906 13.695313 28.816406 13.878906 28.503906C14.058594 28.191406 14.058594 27.808594 13.878906 27.496094C13.695313 27.183594 13.359375 26.996094 13 27L11 27C10.96875 27 10.9375 27 10.90625 27C10.875 27 10.84375 27 10.8125 27C10.78125 27 10.75 27 10.71875 27 Z M 18.71875 27C18.167969 27.078125 17.78125 27.589844 17.859375 28.140625C17.9375 28.691406 18.449219 29.078125 19 29L21 29C21.359375 29.003906 21.695313 28.816406 21.878906 28.503906C22.058594 28.191406 22.058594 27.808594 21.878906 27.496094C21.695313 27.183594 21.359375 26.996094 21 27L19 27C18.96875 27 18.9375 27 18.90625 27C18.875 27 18.84375 27 18.8125 27C18.78125 27 18.75 27 18.71875 27 Z M 26.71875 27C26.167969 27.078125 25.78125 27.589844 25.859375 28.140625C25.9375 28.691406 26.449219 29.078125 27 29L28 29C28.359375 29.003906 28.695313 28.816406 28.878906 28.503906C29.058594 28.191406 29.058594 27.808594 28.878906 27.496094C28.695313 27.183594 28.359375 26.996094 28 27L27 27C26.96875 27 26.9375 27 26.90625 27C26.875 27 26.84375 27 26.8125 27C26.78125 27 26.75 27 26.71875 27 Z M 41.09375 27.625L41.6875 30.0625L38.78125 30.75L38.21875 28.3125C38.484375 28.609375 38.902344 28.71875 39.28125 28.59375L40.25 28.375C40.65625 28.320313 40.992188 28.023438 41.09375 27.625 Z M 4 33L46 33L46 35L4 35 Z M 8 37L9 37L9 44.5C9 44.785156 8.785156 45 8.5 45C8.214844 45 8 44.785156 8 44.5 Z M 41 37L42 37L42 44.5C42 44.785156 41.785156 45 41.5 45C41.214844 45 41 44.785156 41 44.5Z"
					/>
				</svg>

				<small class="text-center text-xs font-medium">Buku</small>
			</a>
			<a
				href="/anggota"
				class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 text-gray-700 hover:bg-blue-300 dark:text-gray-400 dark:hover:bg-slate-800"
			>
				<!-- HeroIcon - Cog-6-tooth -->
				<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g id="SVGRepo_bgCarrier" stroke-width="0" />
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
					<g id="SVGRepo_iconCarrier">
						<path
							d="M18 7.16C17.94 7.15 17.87 7.15 17.81 7.16C16.43 7.11 15.33 5.98 15.33 4.58C15.33 3.15 16.48 2 17.91 2C19.34 2 20.49 3.16 20.49 4.58C20.48 5.98 19.38 7.11 18 7.16Z"
							stroke="#292D32"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
						/>
						<path
							d="M16.9699 14.44C18.3399 14.67 19.8499 14.43 20.9099 13.72C22.3199 12.78 22.3199 11.24 20.9099 10.3C19.8399 9.59004 18.3099 9.35003 16.9399 9.59003"
							stroke="#292D32"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
						/>
						<path
							d="M5.96998 7.16C6.02998 7.15 6.09998 7.15 6.15998 7.16C7.53998 7.11 8.63998 5.98 8.63998 4.58C8.63998 3.15 7.48998 2 6.05998 2C4.62998 2 3.47998 3.16 3.47998 4.58C3.48998 5.98 4.58998 7.11 5.96998 7.16Z"
							stroke="#292D32"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
						/>
						<path
							d="M6.99994 14.44C5.62994 14.67 4.11994 14.43 3.05994 13.72C1.64994 12.78 1.64994 11.24 3.05994 10.3C4.12994 9.59004 5.65994 9.35003 7.02994 9.59003"
							stroke="#292D32"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
						/>
						<path
							d="M12 14.63C11.94 14.62 11.87 14.62 11.81 14.63C10.43 14.58 9.32996 13.45 9.32996 12.05C9.32996 10.62 10.48 9.46997 11.91 9.46997C13.34 9.46997 14.49 10.63 14.49 12.05C14.48 13.45 13.38 14.59 12 14.63Z"
							stroke="#292D32"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
						/>
						<path
							d="M9.08997 17.78C7.67997 18.72 7.67997 20.26 9.08997 21.2C10.69 22.27 13.31 22.27 14.91 21.2C16.32 20.26 16.32 18.72 14.91 17.78C13.32 16.72 10.69 16.72 9.08997 17.78Z"
							stroke="#292D32"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
						/>
					</g>
				</svg>

				<small class="text-center text-xs font-medium">Anggota</small>
			</a>
			<!-- <a
				href="/petugas"
				class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 text-gray-700 hover:bg-blue-300 dark:text-gray-400 dark:hover:bg-slate-800"
			>
				<svg
					fill="#000000"
					
					version="1.1"
					id="Capa_1"
					xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink"
					viewBox="0 0 511 511"
					xml:space="preserve"
				>
					<g>
						<polygon
							points="207,88.147 304,102.005 304,119.5 319,119.5 319,88.995 192,70.853 192,119.5 207,119.5 	"
						/>
						<path
							d="M430.629,260.203L319,228.309v-34.343h-0.168c10.375-13.726,16.168-30.621,16.168-48v-7.36l16-16V47.5
		C351,21.309,329.691,0,303.5,0h-96C181.309,0,160,21.309,160,47.5v75.106l16,16v4.894c0,18.952,6.286,36.505,16.855,50.466H192
		v34.343L80.371,260.203L63.478,511h384.044L430.629,260.203z M431.478,496H383V332.466l34.375-45.833L431.478,496z M207,208.46
		c12.1,9.644,26.967,15.783,43.223,16.836c1.792,0.116,3.572,0.173,5.348,0.173c17.712-0.001,34.529-5.742,48.429-16.498v20.643
		l-48.5,27.714L207,229.614V208.46z M268.286,401.68l-24.718-24.718l0.849-23.553l23.152,28.413L268.286,401.68z M241.438,436.044
		l29.141,29.141l0.703,19.49l-30.498-30.498L241.438,436.044z M242.176,415.57l0.654-18.133l26.251,26.251l0.703,19.49
		L242.176,415.57z M245.314,330.762l-0.082,0.067l0.661-18.329l19.892,19.892l0.887,24.582L245.314,330.762z M264.215,288.866
		l0.777,21.519l-18.359-18.359l0.112-3.108l8.756-10.945L264.215,288.866z M224.266,496H143V319.192l-42.195-49.227l64.982-18.566
		l57.971,66.252l7.268-9.085L224.266,496z M240.045,474.652L261.394,496h-22.118L240.045,474.652z M279.934,308.515l7.309,9.136
		l57.971-66.252l65.749,18.785L368,327.466V496h-81.3L279.934,308.515z M329.267,246.843l-41.509,47.439l-20.924-26.154
		l45.644-26.082L329.267,246.843z M175,116.394V47.5c0-17.92,14.58-32.5,32.5-32.5h96c17.92,0,32.5,14.58,32.5,32.5v68.894l-16,16
		v13.573c0,18.022-7.245,34.738-20.4,47.069c-13.144,12.321-30.334,18.459-48.408,17.292C217.439,208.142,191,178.788,191,143.5
		v-11.106L175,116.394z M198.522,242.046l45.644,26.082l-20.924,26.154l-41.509-47.439L198.522,242.046z M93.75,284.782L128,324.741
		V496H79.522L93.75,284.782z"
						/>
					</g>
				</svg>

				<small class="text-center text-xs font-medium">Petugas</small>
			</a> -->
			<hr class="dark:border-gray-700/60" />
			<button
				class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 text-gray-700 hover:bg-blue-300 dark:text-gray-400 dark:hover:bg-slate-800"
			>
				<svg
					width="800px"
					height="800px"
					viewBox="0 0 24 24"
					fill="#000000"
					xmlns="http://www.w3.org/2000/svg"
				>
					<title />

					<g id="Complete">
						<g id="F-More">
							<path
								d="M8,12a2,2,0,1,1-2-2A2,2,0,0,1,8,12Zm10-2a2,2,0,1,0,2,2A2,2,0,0,0,18,10Zm-6,0a2,2,0,1,0,2,2A2,2,0,0,0,12,10Z"
								id="Horizontal"
							/>
						</g>
					</g>
				</svg>

				<small class="text-center text-xs font-medium">More</small>
			</button>
			<Dropdown placement="right-start">
				<DropdownItem>User</DropdownItem>
				<DropdownItem>Laporan</DropdownItem>
				<DropdownItem>Sign out</DropdownItem>
			</Dropdown>
		</nav>
	</div>
</div>

<!-- component -->
<style>
	.pattern {
		/* From - https://bgjar.com/meteor */
		background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1440' height='560' opacity='0.05' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1021%26quot%3b)' fill='none'%3e%3cpath d='M905 408L904 38' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M607 269L606 125' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M68 213L67 365' stroke-width='8' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1397 326L1396 563' stroke-width='8' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M365 418L364 761' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M293 317L292 38' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1247 130L1246 508' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1339 5L1338 -305' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M831 7L830 -367' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M113 250L112 605' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M967 177L966 -236' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M922 538L921 160' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1109 316L1108 32' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1281 270L1280 50' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1280 403L1279 17' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M308 106L307 490' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M517 147L516 374' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M690 30L689 341' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M614 367L613 154' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M770 486L769 188' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1336 235L1335 573' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M303 441L302 96' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M970 211L969 384' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M151 243L150 26' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M184 391L183 201' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1299 123L1298 -228' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1024 466L1023 254' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1385 330L1384 546' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M991 172L990 552' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M600 461L599 254' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M146 544L145 145' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M539 421L538 723' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1408 130L1407 316' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1134 160L1133 572' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M810 190L809 39' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1069 388L1068 46' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1021'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3clinearGradient x1='0%25' y1='100%25' x2='0%25' y2='0%25' id='SvgjsLinearGradient1022'%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 0)' offset='0'%3e%3c/stop%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 1)' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3clinearGradient x1='0%25' y1='0%25' x2='0%25' y2='100%25' id='SvgjsLinearGradient1023'%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 0)' offset='0'%3e%3c/stop%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 1)' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e");
	}
</style>
