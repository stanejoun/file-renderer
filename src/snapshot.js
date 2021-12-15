"use strict";
var page = require('webpage').create();
var system = require('system');
var target = '';
var output = '';
var extension = '';
var pageWidth = 0;
var pageHeight = 0;

if (system.args.length < 4 || system.args.length > 4) {
	console.log('Usage: snapshot.js target_URL output_filename [parameters]');
	console.log('Parameters exemple: width=600,height=600,extension=jpg');
	console.log('Parameters exemple: width=1920,extension=jpg (height auto)');
	console.log('Parameters exemple: height=1080,extension=jpg (width auto)');
	console.log('Parameters exemple: width=10cm,height=20cm,extension=pdf');
	console.log('Parameters exemple: width=5in,height=7.5in,extension=pdf');
	console.log('Parameters exemple: pageFormat=A4,extension=pdf');
	console.log('Parameters exemple: pageFormat=Letter,extension=pdf');
	phantom.exit(1);
} else {
	try {
		// Automatic shutdown after 30 seconds
		var expirationTime = setTimeout(function () {
			phantom.exit(1);
		}, 30000);
		target = system.args[1];
		output = system.args[2];
		extension = system.args[2].substr(-3);
		if (!system.args[3]) {
			console.log('Missing arguments!');
			clearTimeout(expirationTime);
			phantom.exit(1);
		}
		var args = {};
		if (system.args[3]) {
			var systemArgs = system.args[3].split(',');
			for (var key in systemArgs) {
				var argument = systemArgs[key].split('=');
				args[argument[0]] = argument[1];
			}
		}
		if (args.isContent) {
			page.setContent(decodeURIComponent(escape(window.atob(target))), 'http://localhost');
		}
		// PhantomJs default DPI = 120
		// cm * dpi / 2,54 = px
		// px / dpi * 2.54 = cm
		var settings = {
			top: (args.top) ? args.top : '0',
			left: (args.left) ? args.left : '0',
			width: (args.width) ? args.width : null, // 992px
			height: (args.height) ? args.height : null, // 1403px
			pdfWidth: (args.pdfWidth) ? args.pdfWidth : null, // 21cm
			pdfHeight: (args.pdfHeight) ? args.pdfHeight : null, // 29.7cm
			format: (args.pageFormat) ? args.pageFormat : 'A4', // Supported formats are: 'A3', 'A4', 'A5', 'Legal', 'Letter', 'Tabloid'.
			orientation: (args.orientation) ? args.orientation : 'portrait', // Orientation ('portrait', 'landscape') is optional and defaults to 'portrait'.
			zoomFactor: (args.zoomFactor) ? args.zoomFactor : '1'
		};
		if (extension === 'pdf') {
			if (settings.pdfWidth && settings.pdfHeight) {
				page.paperSize = {
					width: settings.pdfWidth, // Must be a value in units of cm
					height: settings.pdfHeight // Must be a value in units of cm
				};
			} else {
				page.paperSize = {
					format: settings.format, // A3, A4, A5, Legal, Letter, Tabloid
					orientation: settings.orientation, // portrait, landscape
				};
			}
		} else {
			if (settings.width && settings.height) {
				pageWidth = parseInt(settings.width, 10);
				pageHeight = parseInt(settings.height, 10);
				page.viewportSize = {
					width: pageWidth,
					height: pageHeight
				};
				page.clipRect = {
					top: parseInt(settings.top, 10),
					left: parseInt(settings.left, 10),
					width: pageWidth,
					height: pageHeight
				};
			} else if (settings.width) {
				pageWidth = parseInt(settings.width, 10);
				page.viewportSize = {
					width: pageWidth
				};
			} else if (settings.height) {
				pageHeight = parseInt(settings.height, 10);
				page.viewportSize = {
					height: pageHeight
				};
			}
		}
		if (settings.zoomFactor) {
			page.zoomFactor = settings.zoomFactor;
		}
		if (/^https?:\/\/[^\r\n]+$/.test(target)) {
			page.open(target, function (status) {
				if (status !== 'success') {
					console.log('Unable to load the url: "' + target + '".');
					phantom.exit(1);
				}
			});
		}
		page.onLoadFinished = function (status) {
			if (status === 'success') {
				window.setTimeout(function () {
					page.render(output);
					clearTimeout(expirationTime);
					phantom.exit(1);
				}, 3000);
			} else {
				phantom.exit(1);
			}
		};
	} catch (error) {
		console.log('PhantomJs error: ' + error);
		clearTimeout(expirationTime);
		phantom.exit(1);
	}
}