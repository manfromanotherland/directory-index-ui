# Directory index redesigned

I never liked the default styling of the web directory index on macOS, so I redesign it.

| Before 🤢 | After 😍 |
| --- | --- |
| ![Before](before.png) | ![After](after.png) |

## Installing

1. Download the repository and move the .dot files to the directory you want to style – for instance, on macOS that can be the `Sites` folder.
2. Done!

To toggle visibility of .dot's files, do this on Terminal:
```sh
defaults write com.apple.finder AppleShowAllFiles -bool TRUE && killall Finder
```
To get back to the default behavior, just change `TRUE` to `FALSE`.

## Features

- Responsive
- Sort by name or modification date
- Show/hide hidden files
- Uses favicons from directories

## Alternatives

Lots of people have pointed it out alternatives for this project. There's a lot of great stuff out there, so have a look:

- [Apaxy](http://adamwhitcroft.com/apaxy/): enhance the experience of browsing web directories
- [h5ai](https://larsjung.de/h5ai/): a modern HTTP web server index
- [LocalTheme](https://github.com/VictorCamargo/LocalTheme): a beautiful and useful theme for localhost
- [Windex](https://github.com/desandro/windex): stylized directory listings

## Acknowledge

Code heavily taken from [this post](https://css-tricks.com/snippets/php/display-styled-directory-contents/) on CSS-Tricks. So hats off to [Chris Coyier](https://twitter.com/chriscoyier)!
