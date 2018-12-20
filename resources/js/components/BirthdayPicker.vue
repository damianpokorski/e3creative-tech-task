<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Find out exchange rate on your last birthday</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Month:
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col">
                                        <select class="custom-select" v-model="selectedMonth" :changed="updated_month">
                                            <option v-for="(month, index) in months" :value="index+1" :key="index">
                                                {{month}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Day:
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col">
                                        <select class="custom-select" v-model="selectedDay">
                                            <option v-for="day in daysInMonth" :value="day" :key="day">
                                                {{day}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <input class="btn btn-block btn-primary" type="submit" value="Submit" @click="submit">
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
        data: function(){
            return {
                selectedMonth: 1,
                selectedDay: 1
            }
        },
        methods: {
            updated_month: function() {
                this.selectedDay = 1;
            },
            submit: function() {
                alert('submitting!' + this.selectedMonth.toString() + " / " + this.selectedDay.toString());
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        computed: {
            months :function(){
                return [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ]
            },
            daysInMonth: function() {
                let days = [];
                let daysInMonth = new Date((new Date()).getFullYear(), this.selectedMonth, 0).getDate();
                for(let i = 1; i <= daysInMonth; i++ ) {
                    days.push(i);
                }
                return days;
            }
        }
    }
</script>
