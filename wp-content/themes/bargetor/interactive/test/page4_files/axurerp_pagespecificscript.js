for(var i = 0; i < 3; i++) { var scriptId = 'u' + i; window[scriptId] = document.getElementById(scriptId); }

$axure.eventManager.pageLoad(
function (e) {

if (true) {
function waituf49c55ae56a44226a51f81282c2b090e1() {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('page1.html');
}
setTimeout(waituf49c55ae56a44226a51f81282c2b090e1, 1000);

}

if ((GetGlobalVariableValue('trueOrFalse')) == ('1')) {

	SetPanelState('u0', 'pd0u0','none','',500,'none','',500);

SetWidgetFormText('u2', '' + (GetGlobalVariableValue('text')) + '支付成功');

}
else
if ((GetGlobalVariableValue('trueOrFalse')) == ('0')) {

	SetPanelState('u0', 'pd1u0','none','',500,'none','',500);

}

});
