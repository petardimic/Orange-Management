jsOMS.ready(function() {
    // TODO: maybe move all the managers inline?!?!?!
    var eventManager = new jsOMS.EventManager();
    var responseManager = new jsOMS.Response();

    responseManager.add(jsOMS.NOTIFY, notifyMessage);
    responseManager.add(jsOMS.FORMVALIDATION, formValidationMessage);
    responseManager.add(jsOMS.REDIRECT, redirectMessage);
    responseManager.add(jsOMS.RELOAD, reloadMessage);

    var formView = new jsOMS.FormView();
    //formView.identify(); // also responsible for math parsing inside input=text

    //var uiManager = new jsOMS.UIManager(); // responsible for tabs, tables, accordion, animations, element behaviour such as boxes (close, hide)

    //var moduleManager = new jsOMS.ModuleManager();
    //var inputManager = new jsOMS.InputManager();
});