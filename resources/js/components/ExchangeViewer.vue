<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Results for {{formatted_date}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col" v-for="(content, index) in chunked_content" :key="index">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th scope="col">Currency</th>
                                            <th scope="col">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="entry in content" :key="entry.key">
                                            <td>{{entry.key}}</td>
                                            <td>{{entry.value}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                type: Object,
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
            chunked_content: function() {
                let key_value_pairs = this.object_to_key_value_pair(this.api_result.rates);
                return this.array_chunks(key_value_pairs, key_value_pairs.length / 2);
            }
        },
        methods: {
            array_chunks: (array, chunk_size) => Array(Math.ceil(array.length / chunk_size)).fill().map((_, index) => index * chunk_size).map(begin => array.slice(begin, begin + chunk_size)),
            object_to_key_value_pair: (obj) =>  Object
                .keys(obj)
                .map(function(key) {
                    return {key: (key), value:obj[key]};
                }),
        }
    }
</script>
