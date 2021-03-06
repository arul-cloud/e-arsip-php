
    <script src="//asprise.azureedge.net/scannerjs/scanner.js" type="text/javascript"></script>

    <script>
        //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Scan and upload in one go */
        function scanAndUploadDirectly() {
            scanner.scan(displayServerResponse,
                {
                    "output_settings": [
                        {
                            "type": "upload",
                            "format": "pdf",
                            "upload_target": {
                                "url": "<?php echo $globalPath; ?>modul/scanner/upload.php?action=dump",
                                "post_fields": {
                                    "sample-field": "Test scan"
                                },
                                "cookies": document.cookie,
                                "headers": [
                                    "Referer: " + window.location.href,
                                    "User-Agent: " + navigator.userAgent
                                ]
                            }
                        }
                    ]
                }
            );
        }

        function displayServerResponse(successful, mesg, response) {
            if(!successful) { // On error
                document.getElementById('server_response').innerHTML = 'Failed: ' + mesg;
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                document.getElementById('server_response').innerHTML = 'User cancelled';
                return;
            }

            document.getElementById('server_response').innerHTML = scanner.getUploadResponse(response);
			
        }
    </script>

    <style>
        img.scanned {
            height: 100px; /** Sets the display size */
            margin-right: 12px;
        }

        div#images {
            margin-top: 10px;
        }
    </style>

<div class="col-lg-12">
    

    <button type="button" id="btnScanBerkas" class="btn btn-info"  disabled onclick="scanAndUploadDirectly();">Scan and Upload</button>

   
    <div id="server_response"></div>
	
</div>
