(function() {
	
	tinymce.PluginManager.add('mfnsc', function(editor, url) {
		editor.addButton('mfnsc', {
			text : false,
			type : 'menubutton',
			icon : 'mfn-sc',
			classes: 'widget btn mfnsc',
			menu : [ {
				text : 'Column',
				menu : [ {
					text : '1/1',
					onclick : function() {
						editor.insertContent('[one]Insert your content here[/one]');
					}
				}, {
					text : '1/2',
					onclick : function() {
						editor.insertContent('[one_second]Insert your content here[/one_second]');
					}
				}, {
					text : '1/3',
					onclick : function() {
						editor.insertContent('[one_third]Insert your content here[/one_third]');
					}
				}, {
					text : '2/3',
					onclick : function() {
						editor.insertContent('[two_third]Insert your content here[/two_third]');
					}
				}, {
					text : '1/4',
					onclick : function() {
						editor.insertContent('[one_fourth]Insert your content here[/one_fourth]');
					}
				}, {
					text : '2/4',
					onclick : function() {
						editor.insertContent('[two_fourth]Insert your content here[/two_fourth]');
					}
				}, {
					text : '3/4',
					onclick : function() {
						editor.insertContent('[three_fourth]Insert your content here[/three_fourth]');
					}
				}, ]
			}, {
				text : 'Content',
				menu : [ {
					text : 'Alert',
					onclick : function() {
						editor.insertContent('[alert style="warning"]Insert your content here[/alert]');
					}
				}, {
					text : 'Blockquote',
					onclick : function() {
						editor.insertContent('[blockquote author="" link="" target="_blank"]Insert your content here[/blockquote]');
					}
				}, {
					text : 'Button',
					onclick : function() {
						editor.insertContent('[button title="" icon="" icon_position="" link="" target="_blank" color="" font_color="" large="0" class="" download=""]');
					}
				}, {
					text : 'Code',
					onclick : function() {
						editor.insertContent('[code]Insert your content here[/code]');
					}
				}, {
					text : 'Content Link',
					onclick : function() {
						editor.insertContent('[content_link title="" icon="icon-lamp" link="" target="_blank" class="" download=""]');
					}
				}, {
					text : 'Divider',
					onclick : function() {
						editor.insertContent('[divider height="30" style="default" line="default" themecolor="1"]');
					}
				}, {
					text : 'Dropcap',
					onclick : function() {
						editor.insertContent('[dropcap background="" color="" circle="0"]I[/dropcap]nsert your content here');
					}
				}, {
					text : 'Google Font',
					onclick : function() {
						editor.insertContent('[google_font font="" subset="" size="25"]Insert your content here[/google_font]');
					}
				}, {
					text : 'Highlight',
					onclick : function() {
						editor.insertContent('[highlight background="" color=""]Insert your content here[/highlight]');
					}
				}, {
					text : 'Hr',
					onclick : function() {
						editor.insertContent('[hr height="30" style="default" line="default" themecolor="1"]');
					}
				}, {
					text : 'Icon',
					onclick : function() {
						editor.insertContent('[icon type="icon-lamp"]');
					}
				}, {
					text : 'Icon Bar',
					onclick : function() {
						editor.insertContent('[icon_bar icon="icon-lamp" link="" target="_blank" size="" social=""]');
					}
				}, {
					text : 'Icon Block',
					onclick : function() {
						editor.insertContent('[icon_block icon="icon-lamp" align="" color="" size="25"]');
					}
				}, {
					text : 'Idea',
					onclick : function() {
						editor.insertContent('[idea]Insert your content here[/idea]');
					}
				}, {
					text : 'Image',
					onclick : function() {
						editor.insertContent('[image src="" align="" caption="" link="" link_image="" target="" alt="" border="0" animate=""]');
					}
				}, {
					text : 'Popup',
					onclick : function() {
						editor.insertContent('[popup title="Title" padding="0" button="0"]Insert your popup content here[/popup]');
					}
				}, {
					text : 'Share Box',
					onclick : function() {
						editor.insertContent('[share_box]');
					}
				}, {
					text : 'Table',
					onclick : function() {
						editor.insertContent('<table><thead><tr><th>Column 1 heading</th><th>Column 2 heading</th><th>Column 3 heading</th></tr></thead><tbody><tr><td>Row 1 col 1 content</td><td>Row 1 col 2 content</td><td>Row 1 col 3 content</td></tr><tr><td>Row 2 col 1 content</td><td>Row 2 col 2 content</td><td>Row 2 col 3 content</td></tr></tbody></table>');
					}
				}, {
					text : 'Tooltip',
					onclick : function() {
						editor.insertContent('[tooltip hint="Insert your hint here"]Insert your content here[/tooltip]');
					}
				
				}, {
					text : 'Video',
					onclick : function() {
						editor.insertContent('[video_embed video="62954028" width="700" height="400"]');
					}
				}, ]
			}, {
				text : 'Builder',
				menu : [ {
					text : 'Article Box',
					onclick : function() {
						editor.insertContent('[article_box image="" slogan="" title="" link="" target="_blank" animate=""]');
					}
				}, {
					text : 'Blog',
					onclick : function() {
						editor.insertContent('[blog count="2" category="" style="modern" more="1" pagination="0"]');
					}
				}, {
					text : 'Call to Action',
					onclick : function() {
						editor.insertContent('[call_to_action title="" icon="icon-lamp" link="" button_title="" class="" target="_blank" animate=""]Insert your content here[/call_to_action]');
					}
				}, {
					text : 'Chart',
					onclick : function() {
						editor.insertContent('[chart percent="" label="" icon="" image="" title=""]');
					}				
				}, {
					text : 'Clients',
					onclick : function() {
						editor.insertContent('[clients in_row="6" category="" style=""]');
					}
				}, {
					text : 'Clients Slider',
					onclick : function() {
						editor.insertContent('[clients_slider title="" category=""]');
					}
				}, {
					text : 'Contact Box',
					onclick : function() {
						editor.insertContent('[contact_box title="" address="" telephone="" email="" www="" image="" animate=""]');
					}
				}, {
					text : 'Countdown',
					onclick : function() {
						editor.insertContent('[countdown date="12/30/2014 12:00:00" timezone="0"]');
					}
				}, {
					text : 'Counter',
					onclick : function() {
						editor.insertContent('[counter icon="icon-lamp" color="" image="" number="44" title="" type="vertical" animate=""]');
					}
				}, {
					text : 'Fancy Heading',
					onclick : function() {
						editor.insertContent('[fancy_heading title="" h1="0" icon="icon-lamp" slogan="" style="" animate=""]Insert your content here[/fancy_heading]');
					}
				}, {
					text : 'Feature List',
					onclick : function() {
						editor.insertContent('[feature_list][item title="" link="" icon="icon-lamp" animate=""][/feature_list]');
					}
				}, {
					text : 'How It Works',
					onclick : function() {
						editor.insertContent('[how_it_works image="" number="" title="" border="1" link="" target="" animate=""]Insert your content here[/how_it_works]');
					}
				}, {
					text : 'Icon Box',
					onclick : function() {
						editor.insertContent('[icon_box title="" icon="icon-lamp" image="" icon_position="" border="0" link="" target="_blank" animate="" class=""]Insert your content here[/icon_box]');
					}
				}, {
					text : 'Info Box',
					onclick : function() {
						editor.insertContent('[info_box title="" image="" animate=""]Insert your content here[/info_box]');
					}
				}, {
					text : 'List',
					onclick : function() {
						editor.insertContent('[list icon="icon-lamp" image="" title="" link="" target="_blank" style="1" animate=""]Insert your content here[/list]');
					}
				}, {
					text : 'Map',
					onclick : function() {
						editor.insertContent('[map lat="" lng="" height="200" zoom="13"]');
					}
				}, {
					text : 'Opening Hours',
					onclick : function() {
						editor.insertContent('[opening_hours title="" image="" animate=""]Insert your content here[/opening_hours]');
					}
				}, {
					text : 'Our Team',
					onclick : function() {
						editor.insertContent('[our_team image="" title="" subtitle="" email="" phone="" facebook="" twitter="" linkedin="" style="vertical" animate=""]Insert your content here[/our_team]');
					}
				}, {
					text : 'Our Team List',
					onclick : function() {
						editor.insertContent('[our_team_list image="" title="" subtitle="" blockquote="" email="" phone="" facebook="" twitter="" linkedin=""]Insert your content here[/our_team_list]');
					}
				}, {
					text : 'Photo Box',
					onclick : function() {
						editor.insertContent('[photo_box image="" title="" link="" target="_blank" animate=""]Insert your content here[/photo_box]');
					}
				}, {
					text : 'Portfolio',
					onclick : function() {
						editor.insertContent('[portfolio count="2" category="" style="grid" orderby="date" order="DESC" pagination="0"]');
					}
				}, {
					text : 'Pricing Item',
					onclick : function() {
						editor.insertContent('[pricing_item image="" title="" currency="" price="" period="" subtitle="" link_title="" link="" featured="0" style="box" animate=""]<ul><li><strong>List</strong> item</li></ul>[/pricing_item]');
					}
				}, {
					text : 'Progress Bars',
					onclick : function() {
						editor.insertContent('[progress_bars title=""][bar title="Bar1" value="50"][/progress_bars]');
					}
				}, {
					text : 'Promo Box',
					onclick : function() {
						editor.insertContent('[promo_box image="" title="" btn_text="" btn_link="" position="" border="0" target="_blank" animate=""]Insert your content here[/promo_box]');
					}
				}, {
					text : 'Quick Fact',
					onclick : function() {
						editor.insertContent('[quick_fact heading="" number="" title="" animate=""]Insert your content here[/quick_fact]');
					}
				}, {
					text : 'Slider',
					onclick : function() {
						editor.insertContent('[slider category="" orderby="date" order="DESC"]');
					}
				}, {
					text : 'Sliding Box',
					onclick : function() {
						editor.insertContent('[sliding_box image="" title="" link="" target="_blank" animate=""]');
					}				
				}, {
					text : 'Testimonials',
					onclick : function() {
						editor.insertContent('[testimonials category="" orderby="menu_order" order="ASC" border="1"]');
					}
				}, {
					text : 'Trailer Box',
					onclick : function() {
						editor.insertContent('[trailer_box image="" slogan="" title="" link="" target="_blank" animate=""]');
					}
				}, ]
			} ]

		});

	});
	
})();