function itemCreator(className, classParameters, methodNames = [], classFunctions = []) {

    let parameters = '';
    let constructor = '';

    classParameters.forEach((parameter, i) => {
        if (i < (classParameters.length - 1)) {
            parameters += (parameter + ', ');
        } else {
            parameters += parameter;
        }

        constructor += `this.${parameter}=${parameter};`;
    })

    let classCreator = new Function(`return function(${parameters}) {${constructor}}`)();
    window[className] = classCreator;

    classParameters.forEach(parameter => {
        let param = parameter.charAt(0).toUpperCase() + parameter.slice(1);

        window[className].prototype["set" + param] = function (setter) {
            this[parameter] = setter;
        }
    });

    // window[className].prototype["delete"] = classFunctions.delete;
    window[className].prototype["getClassName"] = function () {
        return className;
    };

    methodNames.forEach((methodName, i) => {
        window[className].prototype[methodName] = classFunctions[i];
    });
}
