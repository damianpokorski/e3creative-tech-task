<template>
    <div class="container py-1">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="#" @click="$emit('go_back')"> Go back </a>
                <div class="card card-default">
                    <div class="card-header">Results EUR exchanges for {{this.api_result.date | readabledate}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th scope="col">Currency</th>
                                            <th scope="col">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="entry in processed_content" :key="entry.key">
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
