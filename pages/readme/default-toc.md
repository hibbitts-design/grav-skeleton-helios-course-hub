---
title: ReadMe
published: true
---

Give your course a modern, open home on the web – without building from scratch. This package, combined with the [Grav Premium Helios theme](https://getgrav.org/premium/helios), provides a ready-to-run companion site for one or more courses, with content you fully control. It includes [Grav CMS](https://getgrav.org), an open-source, flat-file CMS with no database required and a built-in browser-based Admin panel.

Helios Course Hub is the successor to the original [Open Course Hub](https://github.com/hibbitts-design/grav-skeleton-course-hub), bringing the same open-education goals to the premium Helios theme with a plugin-based approach.

## Who This Is For

The Helios Course Hub is a **course companion site** – a place to organize and share course content, resources, schedules, and weekly materials alongside your existing LMS (Canvas, Moodle, Brightspace, etc.). It is not a learning management system and does not include enrollment, grade tracking, or student progress features.

It is well suited for educators and teams who want full control over their content, structure, and hosting, including:
- Individual educators wanting a clean, open companion site for one or more courses
- Teams hosting shared course content, reference guides, or topic indexes

Content pages are written in Markdown, with optional shortcodes for embedding and other features. For quick, zero-setup publishing directly from a GitHub or Codeberg repository without a Web server, explore [Docsify-This](https://docsify-this.net).

## Why the Helios Course Hub

The Helios Course Hub gives you a modern, open, and fully controlled companion site that works alone or alongside any LMS – a dedicated home for your course content, resources, and schedules that you control completely.

- Ready in minutes – a complete, pre-configured package with demo content included
- Flexible – host one course or many from a single installation
- Context-aware search – automatically scoped to all courses from the Courses homepage, or narrowed to the current course when browsing within it
- Team-ready – multi-user editing with role-based access rights for team-managed course content
- Yours – host it anywhere PHP runs, customize freely, and keep every word you write
- Open by design – optionally enable the built-in Git Sync and "Edit this Page" support
- Flat-file simplicity – your content is just Markdown files you own and control
- Support open source – your Grav Premium Helios theme purchase directly supports ongoing development of the open-source Grav CMS

## Features

### Site Identity
- Show or hide the site logo icon square next to the Logo Text in the header, with optional custom Tabler icon
- Configurable single course site logo link targeting the Courses Home Page or First Page of Only Listed Course
- Course label with optional icon automatically displayed in the sidebar when multiple courses are published, linking to the first page of the current course
- Per-course favicon support – upload a `favicon.*` file to a course root page's media to override the site favicon for that course

### Course Cards
- Optional course card images – upload an image to a course root page's media and set `image` in frontmatter to display it on the course card, with a choice of side thumbnail or full-width top layout
- Optional course instructor(s) – set `instructor` in frontmatter to display instructor name(s) below the description on the course card
- Optional course badge – set `badge_label` and `badge_color` in frontmatter to display a status badge (e.g. "Coming Soon", "New", "Archived") on the course card

### Course Content
- Alphabetical topics index with auto-generated A–Z navigation
- Announcement shortcode – display a styled notice on any course page, with optional custom title and color type
- MarkdownFile shortcode – fetch and render a remote Markdown file inline, with YAML front matter automatically stripped
- Configurable chapter page description line limit – set the maximum number of lines shown per card description on Chapter template pages (the Modules section uses this template) site-wide via the Helios Course Hub plugin settings (2 default, 3, or no limit)

### Embedding & Shortcodes
- Built-in shortcodes for embedding content (iFrames, Google Slides, PDFs, H5P, Embedly)
- Responsive iframe/video containers with 16:9 aspect ratio
- Embedly card support with automatic dark/light theme detection

### Authoring & Customization
- Git Sync plugin included for syncing site content with GitHub, Codeberg, or similar Git hosting service
- Automatic "Edit this Page" link option provided by the Helios Theme, with support for both GitHub and Codeberg repositories — defaults to **View Page Markdown** (linking to the Markdown source file for open reuse and OER access) and optionally configurable to link directly to file editing for course authors and contributors
- Customizable CSS and JavaScript via the bundled Helios Course Hub plugin
- Print stylesheet with page break control for images, lists, tables, and headings; absolute link URLs displayed inline; and consistent page margins across browsers
- Admin panel styling customizations (increased font sizes and toolbar icon scaling)
- Page Table of Contents template (`default-toc`) – set `template: default-toc` in any page's frontmatter to display a right-column Table of Contents alongside the content

If you prefer not to write Markdown directly, the optional [Grav Premium Editor Pro](https://getgrav.org/premium/editor-pro) provides a visual block editor for editing pages.

## Quick Start

The skeleton is a **complete package** – Grav CMS, the Helios Course Hub plugin, and demo content are all included, but requires the separately licensed [Grav Premium Helios theme](https://getgrav.org/premium/helios). The home page is a Courses listing that shows all active courses – by default, just cpt-363-1/.

### Pre-flight Checklist
1. Confirm your web server meets [Grav's requirements](https://learn.getgrav.org/17/basics/requirements) (PHP 7.3.6 or higher)
2. Have your web server login credentials ready (username and password)

### Installation Steps
1. **Download** the ready-to-run [Grav Helios Course Hub Skeleton](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub/releases/latest) package
2. **Unzip** the package onto your desktop
3. **Copy** the entire Grav Helios Course Hub folder to your web server (e.g. into `public_html/` or a subfolder within it)
4. **Open your browser** and go to your site's URL (e.g. `https://yoursite.com/grav-course-hub`)
5. **Create your site administrator account** when prompted
6. **Enter your Helios and SVG Icons license keys** (or import an existing license file), then install and activate the theme
7. **You're done!** – press the preview icon in the Admin Panel to view your site

See [Course Setup](#course-setup) below to rename folders and edit your pages.

> [!TIP]
> When copying the Grav Helios Course Hub folder to your web server, copy the **entire folder** — it contains hidden files (such as `.htaccess`) that are not selected by default. Omitting these hidden files can cause problems when running Grav.

## Course Setup

All course content lives in course folders within `user/pages/`. The skeleton ships with three pre-configured course folders and a `00.courses/` homepage that lists all visible courses as cards.

```
user/pages/
├── 00.courses/                  # Courses homepage
│   └── course-list.md           # Course list settings and default card values
├── cpt-363-1/                   # Course 1 (published by default)
│   ├── course-card.md           # Course settings (icon, image, instructor, badge)
│   ├── 10.home/
│   ├── 20.essentials/
│   ├── 30.modules/
│   ├── 40.schedule/
│   ├── 50.topics/
│   ├── 60.resources/
│   ├── 70.ux-techniques-guide/
│   └── 80.syllabus/
├── cpt-363-2/                   # Course 2 (same structure, unpublished by default)
├── cpt-363-3/                   # Course 3 (same structure, unpublished by default)
└── readme/
```

Rename the course folders (e.g. `cpt-363-1/` → `comp-101/`) to match your own course codes, either in the Admin Panel or via FTP. The number prefix on each sub-folder (e.g. `10.home/`, `20.essentials/`) controls the page order in the navigation — lower numbers appear first.

By default, only `cpt-363-1/` is published, so the Courses homepage shows a single course card – a clean starting point for a one-course site. To activate additional courses, set **Published** to **Yes** in each course folder's root page. The Course Dropdown appears automatically once more than one course is published, and hides automatically when only one course is active.

### Course Folder Names

Course folders must start with one or more letters, followed by a number. An optional hyphen can separate the letters from the number. Additional version segments (separated by dots or hyphens) are supported.

**Valid names:** `cpt-363-1`, `course-1`, `course-section-1`, `course-section-2`

**Invalid names:** `01.course` (starts with a digit), `course` (no number), `1course` (starts with a digit)

The simplest convention is `course-1`, `course-2`, `course-3`, etc.

### Showing and Hiding Courses

In the Admin panel, open the course folder's root page (e.g. `cpt-363-2`) and set **Published** to **Yes** to show or **No** to hide the course.

> [!TIP]
> When multiple courses are published, the Course Dropdown is useful while building and testing content, but students may find the Courses homepage is sufficient. Once content is finalized, you can hide this dropdown by setting **Show Version Dropdown** to **No** in the Helios Theme settings.

## Courses Homepage

The **Courses** homepage uses the `course-list` template to automatically generate course cards from detected course folders.

### Courses List Page

The `course-list.md` frontmatter controls the list layout and sets default values for all course cards. These fields can be set in the Admin Panel by opening the Courses homepage.

| Field | Default | Description |
|-------|---------|-------------|
| `cards_per_row` | `1` | Number of course cards per row (1–2) |
| `card_icon` | — | Default icon for all course cards (Tabler icon path); also used as the sidebar course label icon when a course has no `icon` of its own |
| `card_image_layout` | `side` | Image layout: `side` (left thumbnail) or `top` (full-width above content) |
| `card_description_lines` | `3` | Maximum description lines per card (2, 3, or 0 for no limit) |

Page content written in `course-list.md` appears above the course cards by default. To also display content **below** the cards, add `===` on its own line as a delimiter:

```markdown
This text appears above the course cards.

===

This text appears below the course cards.
```

If no `===` delimiter is present, all content renders above the cards as normal.

### Course Card Settings

Each course folder contains a `course-card.md` file with frontmatter that controls the course card display. These fields can be set in the Admin Panel by opening the course's root page.

| Field | Description |
|-------|-------------|
| `icon` | Tabler icon path (e.g. `tabler/bulb.svg`); overrides the `card_icon` default from `course-list.md` |
| `description` | Course description shown on the card |
| `instructor` | Optional instructor name(s) shown below the description |
| `badge_label` | Optional status badge label (e.g. `Coming Soon`, `New`, `Archived`) |
| `badge_color` | Optional badge colour (`yellow`, `green`, `red`, etc.) |
| `image` | Optional card image filename (upload to the course's media folder) |

```yaml
---
icon: tabler/bulb.svg
description: A basic introduction to UI/UX design.
instructor: Jane Smith & John Doe
badge_label: Coming Soon
badge_color: yellow
image: banner.jpg
---
```

To display a card image, upload an image file to the course root page's media folder and set `image` in the frontmatter to the filename. Omit the field (or leave it empty) for no image.

## Course Label Customization

The Course dropdown label and its default fallback can be customized in `languages.yaml`. English and French are included:

```yaml
en:
  PLUGIN_HELIOS_COURSE_HUB:
    COURSE_LABEL: Course
    COURSE_LATEST_LABEL: default

fr:
  PLUGIN_HELIOS_COURSE_HUB:
    COURSE_LABEL: Cours
    COURSE_LATEST_LABEL: défaut
```

To customize the label or add a language, update the relevant block in `languages.yaml`.

## Browser Tab Title

The browser tab title is automatically formatted based on how many courses are visible:

- **Single course:** `Page Title | Site Title`
- **Multi-course:** `Page Title | Course Label | Site Title`

For single-course sites, set the Site Title to the course name — it serves as the top-level identifier in the browser tab.

## Git Sync & Open Editing

The skeleton includes the [Git Sync plugin](https://github.com/trilbymedia/grav-plugin-git-sync), which keeps your site content automatically in sync with a GitHub or Codeberg repository. This enables a full open-authoring workflow:

- Content editors can work directly in the Grav Admin or commit changes via Git
- The Helios Theme's **"Edit this Page"** option defaults to a 'View Page Markdown' link on each page, taking readers directly to the Markdown source file in your repository (configurable to link directly to file editing via the Helios Course Hub plugin settings)

## Included Plugin: Helios Course Hub

Custom CSS, JavaScript and shortcodes for the Helios Course Hub theme, plus Admin panel styling. If the Helios theme is not installed, the plugin automatically falls back to the Quark theme so the frontend site remains viewable, redirecting to the License Manager page in the Admin panel. The Course dropdown label can be customized in `languages.yaml` — English and French are included by default.

### Templates
- **default-toc** – Content page template with a right-column Table of Contents. Set `template: default-toc` in any page's frontmatter to enable. Requires the page-toc plugin (included).

### Assets
- **helios.css** – Theme styling (announcement blockquotes, heading typography, Font Awesome spacing, responsive containers)
- **helios.js** – Embedly dark/light theme support with automatic CDN loading
- **print.css** – Print stylesheet (hides navigation chrome, resets colors for light and dark themes, controls page breaks, displays absolute link URLs, sets consistent page margins)
- **admin.css** – Increased Admin panel font sizes and toolbar icon scaling
- **admin.js** – Admin panel JavaScript customizations

### Shortcodes
- [raw]`[iframe url="..."]`[/raw] – Responsive iframe embed, 16:9 by default
- [raw]`[iframe url="..." ratio="4:3"]`[/raw] – Responsive iframe embed at 4:3 ratio
- [raw]`[googleslides url="..."]`[/raw] – Responsive Google Slides embed, 16:9 by default
- [raw]`[googleslides url="..." ratio="4:3"]`[/raw] – Responsive Google Slides embed at 4:3 ratio
- [raw]`[pdf url="..."]`[/raw] – PDF viewer via Google Docs, 16:9 by default
- [raw]`[pdf url="..." ratio="4:3"]`[/raw] – PDF viewer at 4:3 ratio
- [raw]`[pdf url="..." ratio="portrait"]`[/raw] – PDF viewer at portrait ratio (letter/A4)
- [raw]`[h5p url="..."]`[/raw] – H5P interactive content via full embed URL
- [raw]`[h5p id="..."]`[/raw] – H5P interactive content via Content ID (requires H5P Content Embed Source URL to be set in plugin settings)
- [raw]`[embedly url="..."]`[/raw] – Embedly card with dark mode support
- [raw]`[topics]...[/topics]`[/raw] – Alphabetical topics index with auto-generated A–Z navigation, linked letters, and styled letter section labels
- [raw]`[announcement]...[/announcement]`[/raw] – Styled announcement notice (default: Important/purple), supports Markdown content
- [raw]`[announcement title="..." type="..."]...[/announcement]`[/raw] – With optional custom title and type (`note`, `tip`, `important`, `warning`, `caution`)
- [raw]`[markdownfile url="..."]`[/raw] – Fetches and renders a remote Markdown file inline, stripping YAML front matter

### Plugin Settings

The following settings are available in the Admin panel under **Plugins → Helios Course Hub**:

| Setting | Default | Description |
|---------|---------|-------------|
| Show Site Logo Icon | Enabled | Show or hide the icon square next to the Logo Text in the header when no logo image is set |
| Site Logo Icon | _(empty)_ | Tabler icon path for the site logo icon square (e.g. [raw]`tabler/book.svg`[/raw]). Leave empty to use the default icon. Only applies when Show Site Logo Icon is enabled |
| Single Course Site Logo Link | Courses Home Page | Choose where the site Logo Text and icon link navigates: **Courses Home Page** or **First Page of Only Listed Course** (navigates to the first page of the course when only one course is active) |
| Show Plugin Credits | Enabled | Show or hide the "Built with Grav · Helios · Helios Course Hub" attribution line in the footer |
| Description Line Limit | 2 lines | Maximum number of lines shown per card description on Chapter template pages; the Modules section uses this template (2, 3, or no limit) |
| Show Repository Host Icon Link in Header | Enabled | Show or hide the GitHub or Codeberg icon link to the course repository in the site header |
| Git Link Icon | [raw]`tabler/file-text.svg`[/raw] | Tabler icon path for the Git link icon shown in the page footer |
| Git Link Mode | View file | Whether the Git link opens the file for **viewing** (default, for OER access and open reuse) or **editing** (for course authors and contributors with repository access) |
| Repository Host | [raw]`github.com`[/raw] | Repository hosting service for the Helios GitHub Integration ([raw]`github.com`[/raw] or [raw]`codeberg.org`[/raw]) |
| H5P Content Embed Source URL | `https://h5p.org/h5p/embed/` | Base URL for H5P embeds via Content ID (used with [raw]`[h5p id="..."]`[/raw]) |

## Requirements

- PHP >= 7.3.6
- Grav CMS >= 1.7.0
- [Grav Premium Helios Theme](https://getgrav.org/premium/helios) – one license per site ([Standard or Team](https://getgrav.org/premium/license))

## Support

### Contact and Support
- Follow [@hibbittsdesign@mastodon.social](https://mastodon.social/@hibbittsdesign) on Mastodon for updates
- 👩🏻‍💻🧑🏻‍💻 Join the [Grav Discord](https://chat.getgrav.org) and often find me there
- Add a ⭐️ [star on GitHub](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub) to the Helios Course Hub project repository
- For bugs or feature requests, [open an issue](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub/issues) on GitHub

### Professional Services

By leveraging his extensive UX design expertise and systems-oriented approach, Paul helps teams and individuals utilize open content in education and publication settings. Professional services include user experience and workflow consulting, premium support subscriptions, workshops, and custom development. Interested? Send a note to [paul@hibbittsdesign.org](mailto:paul@hibbittsdesign.org).

## License

MIT – Hibbitts Design

> [!TIP]
> Want to no longer display this page on your site? Go to **Helios Theme Settings > Appearance**, scroll down to the bottom of the page and delete the **Header Menu** item **ReadMe**.
