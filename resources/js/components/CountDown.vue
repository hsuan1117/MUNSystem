<template>
    <div>
        <div class="text-center" v-if="currentTime">
     <!-- <span v-if="days">
        Days: {{ days }}<br/>
      </span>
            <span v-if="hours">
        Hours: {{ hours | formatTime }} <br/>
      </span>
            Minutes: {{ minutes | formatTime }} <br/>
            Seconds: {{ seconds | formatTime }} <br/>
            <br/>-->
            <span v-if="days">{{ days }}:</span><span v-if="hours">{{ hours | formatTime }}:</span><span>{{ minutes | formatTime }}:{{ seconds | formatTime }}</span><br />
        </div>
        <div class="text-center" v-if="!currentTime">
            Time's Up!
        </div>
    </div>
</template>

<script>
export default {
    name:"count-down",
    props: {
        deadline: {
            type: String,
            required: true,
        },
        speed: {
            type: Number,
            default: 1000,
        },
    },
    data() {
        return {
            currentTime: Date.parse(this.deadline) - Date.parse(new Date())
        };
    },
    mounted() {
        this.countdown()
        //setTimeout(this.countdown, 1000);
    },
    computed: {
        seconds() {
            return Math.floor((this.currentTime / 1000) % 60);
        },
        minutes() {
            return Math.floor((this.currentTime / 1000 / 60) % 60);
        },
        hours() {
            return Math.floor((this.currentTime / (1000 * 60 * 60)) % 24);
        },
        days() {
            return Math.floor(this.currentTime / (1000 * 60 * 60 * 24));
        }
    },
    filters: {
        formatTime(value) {
            if (value < 10) {
                return "0" + value;
            }
            return value;
        }
    },
    methods: {
        countdown() {
            this.currentTime = Date.parse(this.deadline) - Date.parse(new Date());
            if (this.currentTime > 0) {
                setTimeout(this.countdown, this.speed);
            } else {
                this.currentTime = null;
            }
        }
    },
    watch:{

    }
}
</script>
<!-- Attr: https://gist.github.com/meditatingdragon/c55fc986981636f7739ad1e346b5c757#file-timer-vue -->
