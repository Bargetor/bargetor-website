for(var i = 0; i < 3; i++) { var scriptId = 'u' + i; window[scriptId] = document.getElementById(scriptId); }

$axure.eventManager.pageLoad(
function (e) {

});

u0.style.cursor = 'pointer';
$axure.eventManager.click('u0', u0Click);
InsertAfterBegin(document.body, "<div class='intcases' id='u0LinksClick'></div>")
var u0LinksClick = document.getElementById('u0LinksClick');
function u0Click(e) 
{
windowEvent = e;


	ToggleLinks(e, 'u0LinksClick');
}

InsertBeforeEnd(u0LinksClick, "<div class='intcaselink' onmouseout='SuppressBubble(event)' onclick='u0Clickuc6c58434344646dc9fec053d0b7092ff(event)'>支付成功</div>");
function u0Clickuc6c58434344646dc9fec053d0b7092ff(e)
{

	self.location.href=$axure.globalVariableProvider.getLinkUrl('page2.html');

	ToggleLinks(e, 'u0LinksClick');
}

InsertBeforeEnd(u0LinksClick, "<div class='intcaselink' onmouseout='SuppressBubble(event)' onclick='u0Clicku653653318016431784ea5f3239b719c9(event)'>支付失败</div>");
function u0Clicku653653318016431784ea5f3239b719c9(e)
{

	self.location.href=$axure.globalVariableProvider.getLinkUrl('page3.html');

	ToggleLinks(e, 'u0LinksClick');
}

u1.style.cursor = 'pointer';
$axure.eventManager.click('u1', u1Click);
InsertAfterBegin(document.body, "<div class='intcases' id='u1LinksClick'></div>")
var u1LinksClick = document.getElementById('u1LinksClick');
function u1Click(e) 
{
windowEvent = e;


	ToggleLinks(e, 'u1LinksClick');
}

InsertBeforeEnd(u1LinksClick, "<div class='intcaselink' onmouseout='SuppressBubble(event)' onclick='u1Clickuc4fafbeb5a1b400396f089ee2e4e0609(event)'>支付成功</div>");
function u1Clickuc4fafbeb5a1b400396f089ee2e4e0609(e)
{

SetGlobalVariableValue('trueOrFalse', '1');

SetGlobalVariableValue('text', '' + (GetWidgetText('u2')) + '');

	self.location.href=$axure.globalVariableProvider.getLinkUrl('page4.html');

	ToggleLinks(e, 'u1LinksClick');
}

InsertBeforeEnd(u1LinksClick, "<div class='intcaselink' onmouseout='SuppressBubble(event)' onclick='u1Clickud78dac4d9ac746b081a1f32b8cfbd5bf(event)'>支付失败</div>");
function u1Clickud78dac4d9ac746b081a1f32b8cfbd5bf(e)
{

SetGlobalVariableValue('trueOrFalse', '0');

	self.location.href=$axure.globalVariableProvider.getLinkUrl('page4.html');

	ToggleLinks(e, 'u1LinksClick');
}
