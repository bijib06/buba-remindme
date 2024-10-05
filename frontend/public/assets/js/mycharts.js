
function pieChart(pieType, render, caption, piedata){
	return {
        type: pieType,
        renderAt: render,
        width: '900',
        height: '600',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": caption,
                "subCaption": "Last year",
                "numberPrefix": "$",
                "showPercentValues": "1",
                "showPercentInTooltip": "0",
                //"enableSmartLabels": "1",
                "decimals": "1",
                "skipOverlapLabels": "1",
                //Theme
                "theme": "fint"
            },
            "data": piedata
        },
        events: {
            'beforeRender': function(evt, args) {
                if (!document.getElementById('controllers')) {
                    var controllers = document.createElement('div'),
                        chartRef = evt.sender,
                        showAll,
                        skipOlp,
                        //Function to change chart type
                        changeLabelManagement = function(event) {
                            var val = event.target.getAttribute('value');
                            val && chartRef.setChartAttribute("skipOverlapLabels", val);
                        };
                    controllers.setAttribute('id', 'controllers');

                    // Create radio button inside div
                    controllers.innerHTML = '<label style="padding: 0 5px; display : inline;"><input name="labelMT" id="skip" type="radio" value="1" checked="true"/> Skip Overlapping Labels</label><label style="padding: 0 5px; display : inline;"><input name="labelMT" id="showall" type="radio" value="0" /> Show All Labels</label>';
                    args.container.parentNode.insertBefore(controllers, args.container.nextSibling);
                    //get the radio buttons
                    showAll = document.getElementById('showall');
                    skipOlp = document.getElementById('skip');
                    // setting css styles for controllers div
                    controllers.style.cssText = "position: inherit;width: 500px;padding: 0 80px;";
                    //Set event listener for check boxes
                    showAll.addEventListener && showAll.addEventListener("click", changeLabelManagement);
                    skipOlp.addEventListener && skipOlp.addEventListener("click", changeLabelManagement);

                }
            }
        }
    }
}