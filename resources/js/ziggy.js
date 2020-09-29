    var Ziggy = {
        namedRoutes: {"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"setting.index":{"uri":"settings","methods":["GET","HEAD"],"domain":null},"setting.update":{"uri":"settings","methods":["PUT"],"domain":null}},
        baseUrl: 'https://shark.this/',
        baseProtocol: 'https',
        baseDomain: 'shark.this',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
