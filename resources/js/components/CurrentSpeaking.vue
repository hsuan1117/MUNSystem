<template>
    <div class="card" style="width: 18rem;margin-left: auto;margin-right: auto;">
        <h5 class="card-header">NOW Speaking: <b>{{role}}</b></h5>
        <div class="card-body">
            <vue-countdown-timer
                :start-time="start"
                :end-time="start"
                :interval="1000"
                :end-label="'Last time:'"
                label-position="begin"
                :minutes-txt="'minutes'"
                :seconds-txt="'seconds'">
                <template slot="countdown" slot-scope="scope">
                    <span>{{scope.props.minutes}}</span><i>{{scope.props.minutesTxt}}</i>
                    <span>{{scope.props.seconds}}</span><i>{{scope.props.secondsTxt}}</i>
                </template>
            </vue-countdown-timer>
        </div>
    </div>
</template>

<script>
import CountDown from "./CountDown";
import VueCountdownTimer from 'vuejs-countdown-timer'
export default {
    name: "current-speaking",
    props: ['endpoint'],
    mounted() {
        this.getRole()
        setInterval(this.getRole,1000)
    },
    data(){
      return {
          "role":"Loading ...",
          "start":""
      }
    },
    methods: {
        getRole(){
            let self = this;
            axios.get(self.endpoint).then((res) => {
                self.role = res.data.role || ""
                let start = new Date((Date.parse(res.data.start)+61000)).toISOString()
                //console.log(start)
                self.start = start || ""
            }).catch((error) => {
                console.error(error)
            })
        }
    }
}
</script>
