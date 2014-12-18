function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function mfn_mce_submit() {

	var output;
	var shortcode = document.getElementById('shortcode').value;
	
	switch( shortcode ) {
		case 0:
		case "0":
			tinyMCEPopup.close();
			break;
	
		// ************************* content **********************
		case "alert":
			output = "[" + shortcode + " style=\"warning\"]" +
				"Insert your content here" +
				"[/" + shortcode + "]";
			break;
			
		case "blockquote":
			output = "[" + shortcode + " author=\"\" link=\"\" target=\"_blank\"]" +
			"Insert your content here" +
			"[/" + shortcode + "]";
			break;
			
		case "button":
			output = "[" + shortcode + " title=\"\" icon=\"\" icon_position=\"\" link=\"\" target=\"_blank\" color=\"\"  font_color=\"\" large=\"0\" class=\"\"]";
			break;
			
		case "content_link":
			output = "[" + shortcode + " title=\"\" icon=\"icon-lamp\" link=\"\" target=\"_blank\"]";
			break;
			
		case "divider":
			output = "[" + shortcode + " height=\"30\" style=\"default\" line=\"default\" themecolor=\"1\"]";
			break;
			
		case "dropcap":
			output = "[" + shortcode + " background=\"\" color=\"\" circle=\"0\"]" +
				"I" +
				"[/" + shortcode + "]nsert your content here";
			break;
			
		case "google_font":
			output = "[" + shortcode + " font=\"\" subset=\"\" size=\"25\"]" +
				"Insert your content here" +
				"[/" + shortcode + "]";
			break;
			
		case "highlight":
			output = "[" + shortcode + " background=\"\" color=\"\" line=\"0\"]" +
			"Insert your content here" +
			"[/" + shortcode + "]";
			break;
			
		case "hr":
			output = "[" + shortcode + " height=\"30\" style=\"default\" line=\"default\" themecolor=\"1\"]";
			break;
			
		case "icon":
			output = "[" + shortcode + " type=\"icon-lamp\"]";
			break;
			
		case "icon_bar":
			output = "[" + shortcode + " icon=\"icon-lamp\" link=\"\" target=\"_blank\" size=\"\" social=\"\"]";
			break;	
			
		case "icon_block":
			output = "[" + shortcode + " icon=\"icon-lamp\" align=\"\" color=\"\" size=\"25\"]";
			break;	

		case "image":
			output = "[" + shortcode + " src=\"\" align=\"\" caption=\"\" link=\"\" link_image=\"\" target=\"\" alt=\"\"]";
			break;

		case "table":
			output = "<table><thead><tr><th>Column 1 heading</th><th>Column 2 heading</th><th>Column 3 heading</th></tr></thead><tbody><tr><td>Row 1 col 1 content</td><td>Row 1 col 2 content</td><td>Row 1 col 3 content</td></tr><tr><td>Row 2 col 1 content</td><td>Row 2 col 2 content</td><td>Row 2 col 3 content</td></tr></tbody></table>";
			break;	
			
		case "tooltip":
			output = "[" + shortcode + " hint=\"Insert your hint here\"]" +
			"Insert your content here" +
			"[/" + shortcode + "]";
			break;

		case "video_embed":
			output = "[" + shortcode + " video=\"62954028\" width=\"700\" height=\"400\"]";
			break;
	
			
		// ************************* builder **********************
		case "article_box":
			output = "[" + shortcode + " image=\"\" slogan=\"\" title=\"\" link=\"\" target=\"_blank\"]";
			break;	
			
		case "blog":
			output = "[" + shortcode + " count=\"2\" category=\"\" style=\"modern\" pagination=\"0\"]";
			break;
			
		case "chart":
			output = "[" + shortcode + " percent=\"50\" label=\"\" position=\"left\" title=\"\"]" +
				"Insert your content here" +
				"[/" + shortcode + "]";
			break;	
			
		case "call_to_action":
			output = "[" + shortcode + " title=\"\" icon=\"icon-lamp\" link=\"\" class=\"\" target=\"_blank\"]" +
			"Insert your content here" +
			"[/" + shortcode + "]";
			break;	
	
		case "chart":
			output = "[" + shortcode + " percent=\"\" label=\"\" icon=\"\" image=\"\" title=\"\"]";
			break;
			
		case "clients":
			output = "[" + shortcode + " in_row=\"6\" category=\"\" style=\"\"]";
			break;
			
		case "clients_slider":
			output = "[" + shortcode + " title=\"\" category=\"\"]";
			break;

		case "contact_box":
			output = "[" + shortcode + " title=\"\" address=\"\" telephone=\"\" email=\"\" www=\"\" image=\"\"]";
			break;
				
		case "countdown":
			output = "[" + shortcode + " date=\"12/30/2014 12:00:00\" timezone=\"0\"]";
			break;
			
		case "counter":
			output = "[" + shortcode + " icon=\"icon-lamp\" color=\"\" image=\"\" number=\"44\" title=\"\" type=\"vertical\"]";
			break;
			
		case "fancy_heading":
			output = "[" + shortcode + " title=\"\" icon=\"icon-lamp\" slogan=\"\" style=\"\"]" +
				"Insert your content here" +
				"[/" + shortcode + "]";
			break;
			
		case "feature_list":
			output = "[" + shortcode + "][item title=\"\" link=\"\" icon=\"icon-lamp\"][/" + shortcode + "]";
			break;
			
		case "how_it_works":
			output = "[" + shortcode + " image=\"\" number=\"\" title=\"\" link=\"\" target=\"\" border=\"1\"]" +
			"Insert your content here" +
			"[/" + shortcode + "]";
			break;	
			
		case "icon_box":
			output = "[" + shortcode + " title=\"\" icon=\"icon-lamp\" image=\"\" icon_position=\"\" border=\"0\" link=\"\" target=\"_blank\"]" +
			"Insert your content here" +
			"[/" + shortcode + "]";
			break;	
			
		case "info_box":
			output = "[info_box title=\"\" image=\"\"]Insert your content here[/icon_box]";
			break;	
			
		case "list":
			output = "[list icon=\"icon-lamp\" image=\"\" title=\"\" link=\"\" target=\"_blank\" style=\"1\"]Insert your content here[/list]";
			break;	
			
		case "map":
			output = "[" + shortcode + " lat=\"\" lng=\"\" height=\"200\" zoom=\"13\"]";
			break;
			
		case "opening_hours":
			output = "[opening_hours title=\"\" image=\"\"]Insert your content here[/opening_hours]";
			break;
			
		case "our_team":
			output = "[our_team image=\"\" title=\"\" subtitle=\"\" email=\"\" phone=\"\" facebook=\"\" twitter=\"\" linkedin=\"\" style=\"vertical\"]Insert your content here[/our_team]";
			break;
			
		case "our_team_list":
			output = "[our_team_list image=\"\" title=\"\" subtitle=\"\" blockquote=\"\" email=\"\" phone=\"\" facebook=\"\" twitter=\"\" linkedin=\"\"]Insert your content here[/our_team_list]";
			break;
			
		case "photo_box":
			output = "[photo_box image=\"\" title=\"\" link=\"\" target=\"_blank\"]Insert your content here[/photo_box]";
			break;
			
		case "portfolio":
			output = "[" + shortcode + " count=\"2\" category=\"\" orderby=\"date\" order=\"DESC\" style=\"one\" pagination=\"0\"]";
			break;
			
		case "pricing_item":
			output = "[pricing_item image=\"\" title=\"\" currency=\"\" price=\"\" period=\"\" subtitle=\"\" link_title=\"\" link=\"\" featured=\"\" style=\"box\"]<ul><li><strong>List</strong> item</li></ul>[/pricing_item]";
			break;

		case "progress_bars":
			output = "[progress_bars title=\"\"][bar title=\"Bar1\" value=\"50\"][/progress_bars]";
			break;
			
		case "promo_box":
			output = "[promo_box image=\"\" title=\"\" btn_text=\"\" btn_link=\"\" position=\"\" border=\"0\" target=\"_blank\"]Insert your content here[/promo_box]";
			break;
			
		case "quick_fact":
			output = "[quick_fact heading=\"\" number=\"\" title=\"\"]Insert your content here[/quick_fact]";
			break;
			
		case "slider":
			output = "[slider category=\"\" orderby=\"date\" order=\"DESC\"]";
			break;
			
		case "sliding_box":
			output = "[sliding_box image=\"\" title=\"\" link=\"\" target=\"_blank\"]";
			break;
				
		case "testimonials":
			output = "[" + shortcode + " category=\"\" orderby=\"menu_order\" order=\"ASC\" border=\"1\"]";
			break;			
			
		case "trailer_box":
			output = "[trailer_box image=\"\" slogan=\"\" title=\"\" link=\"\" target=\"_blank\"]";
			break;			
			
			
		// ************************* default **********************
		default:
			output = "[" + shortcode + "] Insert your content here [/" + shortcode + "]";
	}
	

	if (window.tinyMCE) {
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent',false, output);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return true;
}