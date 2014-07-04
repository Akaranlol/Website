frameworkShortcodeAtts={
	attributes:[
			{
				label:"Link URL",
				id:"url",
				help:"Enter the URL for link. (e.g. http://demolink.org)"
			},
			{
				label:"Target",
				id:"target",
				controlType:"select-control",
				selectValues:['_blank', '_self', '_parent', '_top'],
				defaultValue: '_self', 
				defaultText: '_self',
				help:"The target attribute specifies a window or a frame where the linked document is loaded."
			}
	],
	defaultContent:"",
	shortcode:"link"
};
