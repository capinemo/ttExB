
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');
window.VueRouter = require('vue-router');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuex);
Vue.use(VueRouter);

import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

const store = new Vuex.Store({
    state: {
        templates: [], // template list for loading new templates
        actual: null, // selected template
        structure: '', // loaded template structure
        dataset: {}, // current data for structure
        period: null,
        test: 6
    },
    mutations: {
        setTemplates (state, list) {
            state.templates = list;
        },
        setActual (state, id) {
            state.actual = id;

            window.Echo.leave('ReportChannel.' + store.state.actual);

            window.Echo.channel('ReportChannel.' + state.actual)
                .listen('EventChangeReportData', (e) => {
                    // checks & parsing
                    console.log(e.name);
                    state.dataset[e.name] = e.value;
                });
        },
        setStructure (state, arr) {
            state.structure = arr;
            //console.warn('structure', state.structure);
        },
        setDataSet (state, obj) {
            state.dataset = obj;
            //console.warn('dataset', state.dataset);
            //console.warn('html', state.structure.data);
        },
        setPeriod (state, period) {
            state.period = period;
        }
    }
});

const reportComponent = Vue.component('reportComponent', {
    data: function () {
        return {
            link: null
        }
    },
    computed: {
        state: function () {
            return store.state.dataset[this.link];
        }
    },
    template: '<div>{{ state }}</div>',
})

const reportPoint = Vue.component('report_point', {
    render: function (createElement) {
        return createElement('div', {
            domProps: {
                innerHTML: store.state.structure.data
            }
        })
    }
});

Vue.component('report_list', {
    components: {
        reportPoint
    },
    template: '<div v-if="$store.state.structure.data"><reportPoint></reportPoint></div>'
});

const app = new Vue({
    el: '#report_app',
    store,
    methods: {
        loadStructure: function (id) {
            let link = 'http://localhost/api/templates/' + id;

            store.state.dataset = {};

            fetch(link, this.getFetchOptions()).then(function(response) {
                response.text().then(function(text) {
                    store.commit('setActual', id);
                    store.commit('setStructure', app.parseStructure(text));
                    store.commit('setPeriod', null);
                    store.commit('setDataSet', {});

                    app.loadData();
                }).catch(function(err) {
                    //handle error
                });
            });
        },
        loadData: function (id) {
            let period = null;

            if (store.state.period) {
                if (typeof store.state.period === 'string') {
                    period = '?period=' + store.state.period
                }

                if (store.state.period instanceof Array) {
                    period = '?start=' + store.state.period[0] + '&stop=' + store.state.period[1]
                    period = period.replace(' ', '%20')
                }
            }

            if (!store.state.actual) {
                return;
            }

            let link = 'http://localhost/api/templates/' + store.state.actual + '/data'
                + (period ? period : '');

            fetch(link, this.getFetchOptions()).then(function(response) {
                response.text().then(function(text) {
                    store.commit('setDataSet', app.parseData(text));

                    app.createReportComponents();
                }).catch(function(err) {
                    //handle error
                });
            });
        },
        getFetchOptions: function (method = 'GET') {
            let head = new Headers({
                'Authorization': '123'
            });

            return {
                method: method,
                headers: head,
            }
        },
        parseStructure: function (str) {
            try {
                let obj = JSON.parse(str);
                let blocks = {};

                obj.blocks.forEach(function (item) {
                    blocks[item.name] = item;
                });

                obj.blocks = blocks;

                obj.data.match(/reportComponent id="([\d\S]+)"/ig).forEach(function (item) {
                    let block = item.replace('reportComponent id="', '').replace('"', '');

                    obj.data = obj.data.replace(item,
                        item + ' data-type="' + blocks[block].block_type + '"'
                        + ' data-id="' + blocks[block].id + '"'
                    );
                });

                return obj;
            } catch (e) {
                //handle error
            }

            return {};
        },
        parseData: function (str) {
            try {

                let arr = JSON.parse(str);
                let result = {};

                arr.forEach(function (item) {
                    result[item.name] = item.content;
                });

                return result;
            } catch (e) {
                //handle error
            }

            return {};
        },
        createReportComponents: function () {
            for (let key in store.state.dataset) {
                let replaceElement = document.getElementById(key);
                let component = this.componentReportFabric(replaceElement);

                replaceElement.parentNode.replaceChild(component.$mount().$el, replaceElement);
            }
        },
        componentReportFabric: function (element) {
            let type = element.getAttribute('data-type'),
                id = element.getAttribute('data-id'),
                block = element.id,
                component = new reportComponent();

            component.link = block;

            return component;
        },
        setPeriod: function (first, last = null) {
            if (!first) {
                store.commit('setPeriod', null);
            }

            if (first && !last) {
                store.commit('setPeriod', first);
            }

            if (first && last) {
                store.commit('setPeriod', [first, last]);
            }

            this.loadData();
        },
        sendNewValue: function () {
            if (store.state.actual !== 1) {
                return;
            }

            let packet = this.getFetchOptions('POST');
            let data = new FormData();
            data.append( "json", JSON.stringify({
                name: 'block13',
                value: Math.floor(Math.random() * 60) + 1
            }) );

            packet.body = data;

            fetch( 'http://localhost/api/templates/' + store.state.actual + '/set', packet)
                .then(function(res) {
                    console.log(res);
                })
                .catch(function(err) {
                    console.log(err);
                })

        }
    }
});


