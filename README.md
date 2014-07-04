# Pretty Localhost is Pretty

Tired of the default and ugly localhost? You can change that, for free!

## Turn this…

![Localhost Before](http://f.cl.ly/items/3k17123J0E0w2c2r2e3A/localhost%20before.png)

## Into this!

![Localhost After](http://f.cl.ly/items/1j0L2P1M1u2V1B0y463l/localhost%20after.png)

**SUCH PIXELS!**

## How to Install

Download the repository and move the .dot files to your localhost directory – on OS X, that will be the `Sites` folder.

To toggle visibility of .dot's files, do this on Terminal:

    defaults write com.apple.finder AppleShowAllFiles -bool TRUE && killall Finder

To get back to the default behavior, just change `TRUE` to `FALSE`.

## TO DO

- Add keyboard navigation
- Add support for themes
- Options menu (change theme, show hidden files, et cetera)
- Path bar (Finder style)
- Turn this in a Chrome Extension (maybe!)