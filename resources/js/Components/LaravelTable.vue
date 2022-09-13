<script setup>
/* *****************
    Created by 
    Mohamed Fahmi Chaar
***************** */

import { Link } from '@inertiajs/inertia-vue3';
import VRuntimeTemplate from "vue3-runtime-template";
</script>

<template>
    <div class="laravel-datatable">
        <div class="mb-6 flex justify-between items-center">
            <slot name="search-before" :selectedRows="selectedRows"></slot>
            <v-text-field v-if="!hideSearche"
                class="pt-0"
                :value="search"
                @input="onSearch"
                append-inner-icon="search"
                label="Rechercher"
                hide-details
                variant="solo"
                single-line
                clearable
                density="compact"
                :disabled="!query.data || !query.data.length"
            ></v-text-field>
            <slot name="search-after" :selectedRows="selectedRows">
                <template v-if="!hideCreate">
                    <Link v-if="!createInModal" :href="createRoute || route('dashboard.'+datatable.inertiaView+'.create')">
                        <v-btn color="primary" class="text-capitalize ml-3">
                            {{ createText || 'Create' }}
                        </v-btn>
                        <!-- <span class="hidden md:inline"> {{ datatable.inertiaView }}</span> -->
                    </Link>
                    <v-btn v-else color="primary" :loading="createLoading" class="text-capitalize ml-3" @click="showCreateInModal">
                        {{ createText || 'Create' }}
                    </v-btn>
                </template>
            </slot>
        </div>
        <slot name="before-table" :selectedRows="selectedRows"></slot>
        <v-table class="shadow rounded-md">
            <thead>
                <tr>
                    <th class="text-left" v-for="col in headers" :key="col.key">
                        {{ $t(col.text) }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center" v-if="!query.data || !query.data.length">
                    <td colspan="4" class="py-3">
                        <div class="text-xl text-gray-400">{{ $t('datatable.no_data') }}</div>
                        <template v-if="!hideCreate">
                            <Link v-if="!createInModal" :href="createRoute || route('dashboard.'+datatable.inertiaView+'.create')">
                                <v-btn color="primary" class="text-capitalize" size="x-small">
                                    {{ createText || 'Create' }}
                                </v-btn>
                            </Link>
                            <v-btn v-else class="capitalize" size="x-small" :loading="createLoading" color="primary" @click="showCreateInModal">{{ createText || 'Create' }}</v-btn>
                        </template>
                    </td>
                </tr>
                <tr v-for="item in query.data" :key="item.id" :class="[item.cssClass, {'bg-yellow-100': isItemSelected(item)}]">
                    <td v-if="selectable">
                        <v-checkbox hide-details v-if="!item.notSelectable" color="primary" v-model="selectedRows" :value="item"></v-checkbox>
                    </td>
                    <td v-for="(col, index) in headers"
                        :key="index"
                    >
                        <VRuntimeTemplate v-if="col.key != 'actions'"
                            :template="'<div>'+getColValue(item, col.key)+'</div>'">
                        </VRuntimeTemplate>
                        <template v-else>
                            <template v-if="(datatable && datatable.isInertia || datatable && datatable.inertiaView) && !hideActions">
                                <v-tooltip left>
                                    <template v-slot:activator="{ props }">
                                        <template v-if="showAction('show')">
                                            <v-btn size="small" variant="icon" color="default" v-if="showActionModal('show')" @click="showPageAsModal(route('dashboard.'+datatable.inertiaView+'.show', item.id)+(showParams || ''), item, 'show')" :loading="item.showLoading">
                                                <v-icon size="large" v-bind="props" >remove_red_eye</v-icon>
                                            </v-btn>
                                            <Link v-else :href="route('dashboard.'+datatable.inertiaView+'.show', item.id)">
                                                <v-btn size="small" variant="icon" color="default">
                                                    <v-icon size="large" v-bind="props" >remove_red_eye</v-icon>
                                                </v-btn>
                                            </Link>
                                        </template>
                                    </template>
                                    <span>Afficher les détails</span>
                                </v-tooltip>
                                <v-tooltip left>
                                    <template v-slot:activator="{ props }">
                                        <template v-if="showAction('edit')">
                                            <v-btn size="small" variant="icon" color="default" v-if="showActionModal('edit')" @click="showPageAsModal(route('dashboard.'+datatable.inertiaView+'.edit', item.id)+(editParams || ''), item, 'edit')" :loading="item.editLoading">
                                                <v-icon size="large" v-bind="props" >edit</v-icon>
                                            </v-btn>
                                            <Link v-else :href="route('dashboard.'+datatable.inertiaView+'.edit', item.id)">
                                                <v-btn size="small" variant="icon" color="default">
                                                    <v-icon size="large" v-bind="props" >edit</v-icon>
                                                </v-btn>
                                            </Link>
                                        </template>
                                    </template>
                                    <span>Éditer</span>
                                </v-tooltip>
                                <v-tooltip left>
                                    <template v-slot:activator="{ props }">
                                        <v-btn size="small" v-if="showAction('delete')" variant="icon" color="error" @click="deleteRow(item.id)">
                                            <v-icon size="large" v-bind="props" >delete</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Supprimer</span>
                                </v-tooltip>
                            </template>
                            <slot name="extra-actions" :item="item"></slot>
                        </template>
                    </td>
                </tr>
            </tbody>
        </v-table>
        <div class="text-xs-center pt-2" v-if='query.last_page > 1'>
            <v-pagination @input="getDataFromApi" v-model="options.page" :length="query.last_page"></v-pagination>
        </div>
    </div>
</template>

<script>
import { Sortable } from 'sortablejs'
export default {
    props: [
        'data',
        'solo',
        'selectable',
        'sortable',
        'saveOrderUrl',
        'url',
        'createRoute',
        'createInModal',
        'createText',
        'hideSearche',
        'hideCreate',
        'hideActions',
        'actionsModal',
        'actions',
        'searchTerm'
    ],
    components: {
        VRuntimeTemplate
    },
    data() {
        return {
            loading: false,
            createLoading: false,
            search: this.data ? this.data.searchTerm : null,
            headers: [],
            message: 'Silver',
            filters: this.sortable,
            selectedRows: [],
            options: {},
            page: this.data ? this.data.query.current_page : 1,
            datatable: this.data,
            model: this.data ? this.data.model : null,
            query: this.data && this.data.query || {},
            ajaxHeader: [],
            clonedArray: this.data && this.data.query ? JSON.parse(JSON.stringify(this.data.query.data)) : []
        }
    },
    watch: {
        options: {
            handler (newOptions, oldOptions) {
                if (oldOptions.sortBy) {
                    if (newOptions.sortBy[0] &&
                        (newOptions.sortBy[0] != oldOptions.sortBy[0]) ||
                        (newOptions.sortDesc[0] != oldOptions.sortDesc[0])
                    ) {
                        const sortParam = newOptions.sortDesc[0] == false ? `sort=${newOptions.sortBy[0]}` : `sort=-${newOptions.sortBy[0]}`
                        this.getDataFromApi(this.page, sortParam);
                    }
                }
            },
            deep: true
        }
    },
    mounted: async function() {
        if (this.datatable) {
            this.headers = this.createHeaders(this.datatable.headers)
        }
        // if (this.url) {
        //     this.query = {}
        //     await this.getDataFromApi()
        //     this.headers = this.createHeaders(this.ajaxHeader)
        // }
        const { page, search } = this.getParams()
        this.page = Number(page || 1)
        this.search = search
        this.$bus.$on('datatable:refresh', async (params)=> {
            await this.getDataFromApi(this.page, params);
            this.$bus.$emit('datatable:refresh:success')
        })
        Array.prototype.move = function (from, to) {
          this.splice(to, 0, this.splice(from, 1)[0]);
        }
    },
    destroyed() {
        this.$bus.$off('datatable:refresh')
    },
    directives: {
        sortableDataTable: {
            bind: (el, binding, vnode) => {
                if (vnode.context.sortable) {
                    const options = {
                        animation: 150,
                        onUpdate: function (event) {
                            vnode.child.$emit('sorted', event)
                        }
                    }
                    Sortable.create(el.getElementsByTagName('tbody')[0], options)
                }
            }
        }
    },
    methods: {
        onSearch: _.debounce(function(query) {
            this.search = query
            this.page = 1
            this.getDataFromApi(this.page);
        }, 800),
        isItemSelected(item) {
            return this.selectedRows.findIndex(r => r.id === item.id) > -1
        },
        async deleteRow(id) {
            const {value} = await this.$swal({
                title: 'Êtes-vous sûr de vouloir le supprimer',
                // text: this.confirmMessage,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non'
            })
            if (value) {
                this.$inertia.delete(this.route('dashboard.'+this.datatable.inertiaView+'.destroy', id), {
                    onSuccess: () => this.getDataFromApi(this.page)
                })
            }
        },
        createHeaders(headers) {
            let newHeaders = [];
            headers.map(col => {
                if (col.visible != false) {
                    if (this.hideActions && col.value == 'actions' || col == 'actions') {
                        return col
                    }else {
                        newHeaders.push({ 
                            text: col.text || col, 
                            value: col.sortValue || col.value || col,
                            key: col.value || col,
                            sortable: col.sortable == false ? false : true
                        })
                    }
                }
            });
            return newHeaders;
        },
        getColValue(item, key) {
            return _.get(item, key) || '---'
            // const keys = key.split('.')
            // for (let colKey of keys) { item = item[colKey] }
            // return item || '---'
        },
        showAction(action) {
            if (this.actions && this.actions.length) {
                return this.actions.indexOf(action) > -1
            }else if (this.actions && !this.actions.length) {
                return false
            }else {
                return true
            }
        },
        showActionModal(action) {
            if (this.actionsModal && this.actionsModal.length) {
                return this.actionsModal.indexOf(action) > -1
            }else if (this.actionsModal && !this.actionsModal.length) {
                return false
            }else {
                return false
            }
        },
        async showPageAsModal(url, item, action) {
            const loadingKey = `${action}Loading`
            item[loadingKey] = true
            await this.$inertia.visitInModal(url)
            item[loadingKey] = false
        },
        async showCreateInModal() {
            this.createLoading = true
            await this.$inertia.visitInModal(this.createRoute || route('dashboard.'+this.datatable.inertiaView+'.create'))
            this.createLoading = false
        },
        replaceParams(params) {
            const filterParams = this.getParams('http://test.com?'+this.filters)
            const filterKeys = Object.keys(filterParams)
            const _params = this.getParams('http://test.com?'+params)
            for(let paramKey in _params) {
                filterParams[paramKey] = _params[paramKey]
            }
            let query = ''
            const queryObject = {}
            for(let param in filterParams) {
                if (
                    String(filterParams[param]) != 'null' && 
                    String(filterParams[param]) != '-null' && 
                    String(filterParams[param]) != 'undefined' && 
                    String(filterParams[param]) != '-undefined'
                ) {
                    queryObject[param] = filterParams[param]
                    query += `${param}=${filterParams[param]}&`
                }
            }
            return {queryString: query.substr(0, query.length-1), queryObject}
        },
        initData(data) {
            this.datatable = data
            this.query = data.query || {};
            this.model = data.model
            this.ajaxHeader = data.headers
            this.clonedArray = JSON.parse(JSON.stringify(data.query.data))
            this.selectedRows = []
        },
        async getDataFromApi(page = null, params) {
            this.filters = this.replaceParams(params)
            this.loading = true;
            const queryParams = this.buildQueryParams({
                ...this.getParams(),
                page,
                search: this.search,
                ...this.filters.queryObject,
            })
            let url = (this.url || this.query.path) + '?' + queryParams
            const firstOccuranceIndex = url.search(/\?/) + 1;
            url = url.substr(0, firstOccuranceIndex) + url.slice(firstOccuranceIndex).replace(/\?/g, '&');
            this.$inertia.visit(url)
        },
        buildQueryParams(obj, prefix) {
            var str = [],
                p;
            for (p in obj) {
                if (obj.hasOwnProperty(p)) {
                    var k = prefix ? prefix + "[" + p + "]" : p,
                    v = obj[p];
                    if (v !== null && v !== undefined) {
                        str.push(typeof v === "object" ?
                            serialize(v, k) :
                            k + "=" + encodeURIComponent(v)
                        );
                    }
                }
            }
            return str.join("&");
        },
        getQuery (url = window.location.href) {
            const parser = document.createElement('a');
            parser.href = url;
            const query = parser.search.substring(1);
            return query;
        },
        getParams (url = window.location.href) {
            let params = {};
            let parser = document.createElement('a');
            parser.href = url;
            let query = parser.search.substring(1);
            let vars = query.split('&');
            for (let i = 0; i < vars.length; i++) {
                let pair = vars[i].split('=');
                if (String(pair[0]) != 'null' && String(pair[0]) != "undefined")
                    params[pair[0]] = decodeURIComponent(pair[1]);
            }
            return params;
        },
        saveOrder (event) {
            this.clonedArray.move(event.oldIndex, event.newIndex)
            if (this.model) {
                try {
                    axios.post(this.saveOrderUrl || '/dashboard/save-order', {
                        newOrder: this.clonedArray.map(f => f.id),
                        model: this.model
                    })
    
                }catch(e) {
                    console.error('Error when save new order', e)
                    this.$swal({icon: 'error', title: `Error when save new order`, text: e.response ? e.response.data.message : 'Internal server error'})
                }
            }
        }
    }
}
</script>

<style scoped>
.laravel-datatable .v-input--checkbox {
    margin: 0 !important;
}
.laravel-datatable .v-input--checkbox .v-input__slot {
    width: fit-content !important;
}
</style>