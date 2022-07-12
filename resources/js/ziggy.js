const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"survey.index":{"uri":"survey","methods":["GET","HEAD"]},"survey.create":{"uri":"survey\/create","methods":["GET","HEAD"]},"survey.store":{"uri":"survey","methods":["POST"]},"survey.show":{"uri":"survey\/{survey}","methods":["GET","HEAD"]},"survey.edit":{"uri":"survey\/{survey}\/edit","methods":["GET","HEAD"]},"survey.update":{"uri":"survey\/{survey}","methods":["PUT","PATCH"]},"survey.destroy":{"uri":"survey\/{survey}","methods":["DELETE"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
