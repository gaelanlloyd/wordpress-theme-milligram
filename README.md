# wordpress-theme-milligram
A barebones WordPress theme using the [Milligram](https://milligram.io/) grid framework.

Very little is built into this theme, on purpose. Use it as a starting point with Milligram, or easily change to any other CSS framework you desire ([Bootstrap](https://getbootstrap.com/), etc.)

## Features:

- **Cleaned up dashboard.** Remove all of the unecessary widgets and panels from the dasboard, giving you a clean slate upon login.
- **Robust function includer.** Simply add additional files into the `functions` folder and use the `mg` namespace.
- **Global data handler.** Useful for storing and retrieving data from global variables with a standardized syntax.
- **Basic user lockdown.** Dissuade editors from creating new taxonomy terms by hiding the *new term* input fields.
- **Useful title meta writer.** Make those page titles look better, out of the box.
- **Page template debugger.** The active page template will be output in a comment on every page for helpful debugging.
- **Google Analytics / Google Tag Manager code spot.** Pop your GA/GTM embed code into `includes/ga.php`. By default, this code won't be output if you're signed in to WordPress, to help prevent internal traffic from being counted.