<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Commonly checked birthdays</div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action" v-for="entry in api_result" :key="entry.endpoint"
                            @click="$emit('open', entry.endpoint)"
                            >
                                {{entry.endpoint | readabledate}}
                                <span class="badge badge-pill badge-secondary p-1">{{entry.hits}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    export default {
        props: {
            api_result: {
                type: Array,
                default: null
            }
        },
        data: function(){
            return {
                date: '1st of Janury'
            }
        },
        computed: {
            formatted_date: function() {
                return moment(this.api_result.date).format("Do MMMM YYYY");
            },
            processed_content: function() {
                return this.object_to_key_value_pair(this.api_result.rates);
            }
        },
        methods: {
            object_to_key_value_pair: (obj) =>  Object
                .keys(obj)
                .map(function(key) {
                    return {key: (key), value:obj[key]};
                })
        }
    }
</script>
