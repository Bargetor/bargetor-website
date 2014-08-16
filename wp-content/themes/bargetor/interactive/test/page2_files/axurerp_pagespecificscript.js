for(var i = 0; i < 27; i++) { var scriptId = 'u' + i; window[scriptId] = document.getElementById(scriptId); }

$axure.eventManager.pageLoad(
function (e) {

});

if (bIE) document.getElementById('u2').attachEvent("onmousedown", function(e) { StartDragWidget(e, 'u2'); });
else {
    document.getElementById('u2').addEventListener("mousedown", function(e) { StartDragWidget(e, 'u2'); }, true);
    document.getElementById('u2').addEventListener("touchstart", function(e) { StartDragWidget(e, 'u2'); }, true);
}

widgetIdToSwipeLeftFunction['u2'] = function() {
var e = windowEvent;

if (true) {

	SetPanelStateNext('u2',true,'swing','left',500,'none','',500);

}

}

widgetIdToSwipeRightFunction['u2'] = function() {
var e = windowEvent;

if (true) {

	SetPanelStatePrevious('u2',true,'none','',500,'swing','right',500);

}

}
gv_vAlignTable['u16'] = 'center';gv_vAlignTable['u8'] = 'center';gv_vAlignTable['u6'] = 'center';gv_vAlignTable['u14'] = 'center';
u1.style.cursor = 'pointer';
$axure.eventManager.click('u1', function(e) {

if (true) {

	SetPanelStateNext('u2',true,'swing','left',500,'none','',500);

}
});
gv_vAlignTable['u10'] = 'center';gv_vAlignTable['u4'] = 'center';gv_vAlignTable['u12'] = 'center';gv_vAlignTable['u26'] = 'center';gv_vAlignTable['u24'] = 'center';gv_vAlignTable['u18'] = 'center';gv_vAlignTable['u20'] = 'center';gv_vAlignTable['u22'] = 'center';