<!-- incl. wishlist_informer -->
{if !empty($wished_products)}
	<a href="/wishlist" class="svgwrapper" title="Избранное">
		<svg id="icon_hart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.94 33.53"><path fill="#c30c21" class="cls-1" d="M33.62,4.44a9.17,9.17,0,0,0-6.68-2.36,7.61,7.61,0,0,0-2.4.41,9.87,9.87,0,0,0-2.29,1.1c-.7.47-1.31.9-1.81,1.31A16.1,16.1,0,0,0,19,6.19,16.1,16.1,0,0,0,17.54,4.9c-.5-.41-1.11-.84-1.81-1.31a9.87,9.87,0,0,0-2.29-1.1A7.61,7.61,0,0,0,11,2.08,9.17,9.17,0,0,0,4.36,4.44,8.72,8.72,0,0,0,1.94,11a8.31,8.31,0,0,0,.45,2.63,11.54,11.54,0,0,0,1,2.3A17.22,17.22,0,0,0,4.7,17.77c.48.6.84,1,1.06,1.24a5.4,5.4,0,0,0,.52.5L18.15,31a1.21,1.21,0,0,0,1.68,0L31.68,19.55Q36,15.19,36,11a8.72,8.72,0,0,0-2.42-6.54ZM30,17.76,19,28.39l-11-10.65C5.57,15.37,4.38,13.11,4.38,11a8.41,8.41,0,0,1,.41-2.72,5.35,5.35,0,0,1,1-1.87A5.21,5.21,0,0,1,7.38,5.26a7,7,0,0,1,1.79-.59A11.16,11.16,0,0,1,11,4.52,5.51,5.51,0,0,1,13.17,5a9.94,9.94,0,0,1,2.1,1.22c.64.49,1.19.94,1.65,1.37a15.18,15.18,0,0,1,1.14,1.17,1.24,1.24,0,0,0,1.86,0,15.18,15.18,0,0,1,1.14-1.17c.46-.43,1-.88,1.65-1.37A9.94,9.94,0,0,1,24.81,5a5.51,5.51,0,0,1,2.13-.48,11.16,11.16,0,0,1,1.87.15,6.76,6.76,0,0,1,1.78.59,5.13,5.13,0,0,1,1.56,1.13,5.35,5.35,0,0,1,1,1.87A8.41,8.41,0,0,1,33.6,11q0,3.19-3.58,6.78Zm0,0"/></svg>
		<div class="count">{$wished_products|count}</div>
	</a>
{else}
	<div class="svgwrapper" title="Избранное">
		<svg id="icon_hart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.94 33.53"><path class="cls-1" d="M33.62,4.44a9.17,9.17,0,0,0-6.68-2.36,7.61,7.61,0,0,0-2.4.41,9.87,9.87,0,0,0-2.29,1.1c-.7.47-1.31.9-1.81,1.31A16.1,16.1,0,0,0,19,6.19,16.1,16.1,0,0,0,17.54,4.9c-.5-.41-1.11-.84-1.81-1.31a9.87,9.87,0,0,0-2.29-1.1A7.61,7.61,0,0,0,11,2.08,9.17,9.17,0,0,0,4.36,4.44,8.72,8.72,0,0,0,1.94,11a8.31,8.31,0,0,0,.45,2.63,11.54,11.54,0,0,0,1,2.3A17.22,17.22,0,0,0,4.7,17.77c.48.6.84,1,1.06,1.24a5.4,5.4,0,0,0,.52.5L18.15,31a1.21,1.21,0,0,0,1.68,0L31.68,19.55Q36,15.19,36,11a8.72,8.72,0,0,0-2.42-6.54ZM30,17.76,19,28.39l-11-10.65C5.57,15.37,4.38,13.11,4.38,11a8.41,8.41,0,0,1,.41-2.72,5.35,5.35,0,0,1,1-1.87A5.21,5.21,0,0,1,7.38,5.26a7,7,0,0,1,1.79-.59A11.16,11.16,0,0,1,11,4.52,5.51,5.51,0,0,1,13.17,5a9.94,9.94,0,0,1,2.1,1.22c.64.49,1.19.94,1.65,1.37a15.18,15.18,0,0,1,1.14,1.17,1.24,1.24,0,0,0,1.86,0,15.18,15.18,0,0,1,1.14-1.17c.46-.43,1-.88,1.65-1.37A9.94,9.94,0,0,1,24.81,5a5.51,5.51,0,0,1,2.13-.48,11.16,11.16,0,0,1,1.87.15,6.76,6.76,0,0,1,1.78.59,5.13,5.13,0,0,1,1.56,1.13,5.35,5.35,0,0,1,1,1.87A8.41,8.41,0,0,1,33.6,11q0,3.19-3.58,6.78Zm0,0"/></svg>
	</div>
{/if}
<!-- incl. wishlist_informer @ -->
