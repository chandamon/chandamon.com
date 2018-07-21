=== PollPress ===
Tags: polls, vote
Contributers: Andy Finnell

PollPress is a plugin that allows you to add polls, similar to slashdot, to your blog. Poll creation and management is very similar to creating and managing normal posts. The plugin allows users to vote on the most recent poll from the sidebar, and the poll results are displayed in a post, where users can comment. The plugin also adds an archive page for the polls, where users can browse and vote on older polls.

== Installation ==

1. Download the PollPress plugin.
2. Extract the plugin from the zip file. You should get a folder named PollPress. In it you will find a file called readme.txt and the actual plugin folder called pollpress.
3. Upload the inner pollpress folder to your plugins folder, which is usually called 'wp-content/plugins/'.
4. From the Plugins administration panel, activate the PollPress plugin.
5. To install the voting booth on the sidebar, you need to add some code, <?php pollpress_voting_booth(); ?>, as described next.
6. In the administration panel, click the 'Presentation' tab, then the 'Theme Editor' tab.
7. In the theme files list on the right, click on 'Sidebar'.
8. In the code, find the desired location in the sidebar to add the voting booth. At this location, insert the code <?php pollpress_voting_booth(); ?>. If the sidebar is like most, you will need to put it inside list item tags, like this: <li><?php pollpress_voting_booth(); ?></li>
9. Press the 'Update File' button.

== Frequently Asked Questions ==

= What are the requirements for this plugin? =

WordPress 2.0 or above.

= How do I change the color of the bar graph in the results? =

In the administration panel, select the 'Options' tab, then the 'PollPress' tab. In the 'Bar Color' field, enter the hexidecimal value of the desired color, and press 'Update Options'. The color must start with a #, and be followed by the red, green, and blue components. Like CSS, it will accept either a group of three or six. The box next the field shows the current used color.

= Can I use PollPress for scientific research? =

No. PollPress does not stop ballot stuffing or really any kind of nefarious end user behavior. 

== Screenshots ==

1. This is the voting booth. It shows up in the sidebar of the blog and in the Polls archive page, allowing users to do novel things like vote on a poll.

2. This is the poll results post. The color of the graph can be changed in the Options panel. It allows users to comment, if you allow them.

3. This is the poll archives page, dynamically created by PollPress. It lists all the polls in chronological order, and allows the user to vote or view the results of any poll.

4. This is the poll editing page. It allows you to add options, reset vote counts, and reorder the options. Although not shown, it also has the standard options most posts have, such as categories, author, timestamps, and password options.
