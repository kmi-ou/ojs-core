(function($) {
	// helper function to work with the templates, replaces placeholders with strings
	String.prototype.placeContent = function() {
		var formatted = this;
		for (var arg = 0; arg < arguments.length; arg++) {
			formatted = formatted.replace("{" + arg + "}", arguments[arg]);
		}
        return formatted;
	};
	
	$.fn.coreWidget = function(title,options) {
		var placeHolder = this;
        
     
        
		var settings = {
			"serverUrl": "http://core.kmi.open.ac.uk/widget2", 
			"widgetTpl": "\
                <div class='separator'></div>\
				<div class=\"coreWidget\">\
                	<h3>" + title + "</h3>\
					<ul>\
					{0}\
					</ul>\
					<div class=\"footer\">\
						<a href=\"{1}\" onclick=\"window.open(this.href); return false;\">Powered by <img src=\"{2}\"></a>\
					</div>\
				</div>\
			",
			"documentTpl": "\
				<li><a href=\"{0}\">{1}</a></li>\
			"
		};
   // extend settings if the override is available
		if (options) {
			$.extend(settings, options);
		}

		var xhr = null;
		// api key and at least one of OAI, URL or abstract have to be specified
		if (settings.apiKey && (settings.documentOAI || settings.documentUrl || settings.documentAbstract)) {
			// use the JSONP call to retrieve the data from given server
            xhr = $.ajax({
				url: settings.serverUrl, 
				dataType: "jsonp",
                crossDomain : true,
				data: {
				    oai: settings.documentOAI,
                    url: settings.documentUrl,
				    title: settings.documentTitle,
				    authors: settings.documentAuthors,
				    aabstract: settings.documentAbstract,
				    api_key: settings.apiKey
				},
                beforeSend: function(){
                },
                timeout: 10000,
                
				success: function(data) {
                if (data==""){
                    console.log("will do nothing plugin will not render a box");
                    return;
                }
					var documentsHtml = "", 
						document = null;
					if (data && (0 < data.count)) {
						// add all the document using pre-defined template
						for(i = 0; i < data.documents.length; ++i) {
							document = data.documents[i];
							documentsHtml += settings.documentTpl.placeContent(document.url, document.name);
						}
						// put together the widget template
						placeHolder.append(
							settings.widgetTpl.placeContent(documentsHtml, 
								data.serverUrl, data.serverLogoUrl
							)
						);
					}
				},
                error: errorHandler
            });
            // to stop a jsonp call, you must remove the <script> tag from the DOM
            function errorHandler(jqXHR, status, error) {
             if (status == 'timeout') {
             } else {
                
             }
             console.log('Error');
            };
		}
	};
})(jQuery);
