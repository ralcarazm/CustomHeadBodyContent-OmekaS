# Custom Head and Body Content for Omeka S

CustomHeadBodyContent is a module for Omeka s that let you to add HTML, CSS or JS code to the head and body sections of the website

## What it does

It adds a configuration screen in **Modules → Custom Head and Body Content → Configure** with two fields:

- **Custom `<head>` content**: injected into public HTML pages immediately before `</head>`.
- **Custom body content**: injected into public HTML pages immediately before `</body>`.

Typical uses include:

- analytics or tag-manager snippets
- verification meta tags
- external stylesheets or scripts
- custom inline CSS or JavaScript

## Installation

1. Rename and copy the folder to `modules/CustomHeadBodyContent` inside your Omeka S installation.
2. Make sure the folder contains `Module.php` and `config/module.ini`.
3. Install the module from the Omeka S admin interface.
4. Open **Configure**, paste your custom markup and save.

## Notes

- The module stores its configuration in global Omeka settings.
- The code is only injected into HTML responses outside the admin and API routes.
- The configured markup is output **without escaping**, by design, so only trusted administrators should use it.
