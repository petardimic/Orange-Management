jsOMS.ready(function() {
    // TODO: maybe move all the managers inline?!?!?!
    var eventManager = new jsOMS.EventManager();
    var responseManager = new jsOMS.ResponseManager();

    responseManager.add('notify', notifyMessage);
    responseManager.add('validation', formValidationMessage);
    responseManager.add('redirect', redirectMessage);
    responseManager.add('reload', reloadMessage);

    var formManager = new jsOMS.FormManager(responseManager);
    formManager.bind();
    //formView.identify(); // also responsible for math parsing inside input=text

    //var uiManager = new jsOMS.UIManager(); // responsible for tabs, tables, accordion, animations, element behaviour such as boxes (close, hide)

    //var moduleManager = new jsOMS.ModuleManager();
    //var inputManager = new jsOMS.InputManager();
});