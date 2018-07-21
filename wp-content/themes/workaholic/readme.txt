=== Workaholic ===

== Installation ==
This section describes how to install Workaholic and get it working. 

	1. Download Workaholic from your Graph Paper Press [member dashboard](https://graphpaperpress.com/members/member.php) to your Desktop.
	2. Unzip workaholic.zip to your Desktop.	
		* Note: make sure that the extracted folder is `workaholic` and that your ZIP file has not created two levels of folders (for example, `workaholic/workaholic`).
	
	3. Go to `/wp-content/themes/` and make sure that you do not already have a `workaholic` folder installed. If you do, then back it up and remove it from `/wp-content/themes/` before uploading your copy of Workaholic.
	4. Upload `workaholic` to `/wp-content/themes/`.
	5. Activate Workaholic through the Appearance -> Themes menu in your WordPress Dashboard.
	6.In Wordpress, click on Media Settings. Set your thumbnails to 270 x 150. Set your medium photo size to 570. Set your large size to 950.
This theme will automatically create thumbnails from the images that you upload. By default, the thumbnail size is 270 x 150. This can be easily changed, if you know a little bit of CSS.
	7. If you plan on self-hosting your own video to use the theme's built-in HD video player, you need to use the Post Thumbnail text field on the Write Post panel and paste the URL to your video thumbnail. The dimensions of the thumbnail should exactly match the dimensions of the video dimensions that you plug into the Post Video Options panel.
				
		
		* Embeds
			** [checked] When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube.
			** Maximum embed size
				*** Width: 620
				*** Height: 0

= Theme Options =

When you initially activate this theme, you will be prompted to install the OptionTree plugin.  This plugin adds Theme Options to WordPress for easily changing the design of Widescreen.  After activating the plugin, visit the Appearance -> Theme Options page to begin building your site.


= Setting Up Portfolio Slider =

When you post a new post, click the Add an Image button (small icon on the top of the post text area). You will get the Add an Image window. Click Select Files and select your images / screenshots. Once you upload an image or a set of images, click Save Changes. Don't click Insert into Post button. Then close the Add an Image window. You will not get any text / images on the post text area but these images has been added to the database. You can write up any additional text about the portfolio item.

Below your post text area, you should see the area called Excerpt. Add any one line excerpt that describes the portfolio item. This excerpt will be used in the sidebar (under Similar Projects). The sidebar on each Portfolio item shows 10 other items from the same category randomly.

= Thumbnails =

Every Post needs to have a Featured Image assigned to it.  You can assign a Featured Image by uploading an image to the Post, and then click the "Use as featured image" button to make the image the Featured Image for that post.  [Watch a video tutorial](http://vimeo.com/8462281).

If you are migrating from an old theme to a new theme and your thumbnails look squished or distorted, you might need to re-upload the image you plan on using for the post thumbnail. This is because WordPress creates your image sizes based on the dimensions you specified above. Old thumbnails will not be automatically resized.  You can regenerate your thumbnails with the [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) WordPress plugin.

= Video =

Paste the link to your video onto any page or post and WordPress will automatically embed the video from the link.

= Menus = 

This theme has built-in support for WordPress' new Menu system, which will be released in version 3.0. This new system, which can be accessed at Appearance -> Menus, allows you to drag and drop menu items with total ease. You can also add custom links.

= Widgets: =

	* There are a total of four widgetized areas on this theme in addition to the default sidebar. The bottom area on the homepage three-column area is 100% widgetized. You can add and delete widgets by clicking Appearance -> Widgets, from within your Wordpress admin panel.

= Advertising =

	* This theme has two built-in spots for advertising: One in the sidebar, which measures 310 pixels wide, and one underneath the main post, which measures 590 pixels wide. You can add your adversing code on the Theme Options panel.