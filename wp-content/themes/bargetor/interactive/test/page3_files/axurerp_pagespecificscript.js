for(var i = 0; i < 8; i++) { var scriptId = 'u' + i; window[scriptId] = document.getElementById(scriptId); }

$axure.eventManager.pageLoad(
function (e) {

});

u7.style.cursor = 'pointer';
$axure.eventManager.click('u7', function(e) {

if (true) {

	SetPanelState('u1', 'pd1u1','none','',500,'none','',500);

	SetPanelState('u4', 'pd1u4','none','',500,'none','',500);

}
});
