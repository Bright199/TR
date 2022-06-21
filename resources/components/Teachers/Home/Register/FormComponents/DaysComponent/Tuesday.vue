<template>
    <div class="col-md-8">
        <div class="row">
            <div class="container bg-light p-3">
                <h2 class="text-center">TUESDAY</h2>
            </div>
            <div class="col-md-6 slot-list">
                <p class="text-center p-3">Select time slots</p>
                <ul>
                    <li v-for="(slot, index) in timeSlots()" :key="index" @click="selectTimeSlot(index, slot)">{{
                            slot
                    }}</li>
                </ul>
            </div>
            <div class="col-md-6 selected-slot-list">
                <p class="text-center p-3">Selected availability slots</p>
                <ul>
                    <li v-for="(chosenSlot, index) in filterSelectedSlotList" :key="index">
                        {{ chosenSlot.selected_timeslot }}
                        <span class="slot-delete" @click="removeSLot(index)">
                            <i class="fa-solid fa-trash-can"></i>
                        </span>
                    </li>
                </ul>
                <button class="save-slot-btn" @click="saveTimeSlot">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment-timezone'
import axios from 'axios'
export default {
    name: 'Tuesday',
    data() {
        return {
            selectedSlotList: [],
            startTime: '00:00',
            endTime: '23:00',
        }
    },
    methods: {
        saveTimeSlot() {
            if (this.selectedSlotList.length) {
                this.selectedSlotList.push({ day: 'Tuesday' })
                axios.post('/teacher/saveTeacherAvailability',this.selectTimeSlot)
                .then(res =>{
                    alert('saved')
                })
                .catch(error =>{
                    console.log(error);
                })
                console.log(this.selectedSlotList);
            }
        },
        timeSlots() {
            var strtT = moment(this.startTime, 'HH:mm')
            var endT = moment(this.endTime, 'HH:mm')
            if (endT.isBefore(strtT)) {
                endT.add(1, 'day')
            }
            var allTimeSlots = [];
            while (strtT <= endT) {
                allTimeSlots.push(new moment(strtT).format('HH:mm'))
                strtT.add(1, 'hour');
            }
            return allTimeSlots;
        },
        removeSLot(i) {
            this.selectedSlotList.splice(i, 1);
        },
        selectTimeSlot(i, slt) {
            const slotExists = this.selectedSlotList.some(tslot => {
                if (tslot.selected_timeslot === slt) {
                    return true;
                }
                return false;
            })


            if (
                !slotExists
            ) {
                let slotNumber = 'slot_' + (i + 1)
                const selectedTimeSlotDetails = {
                    [slotNumber]: slt,
                    selected_timeslot: slt
                }

                this.selectedSlotList.push(selectedTimeSlotDetails)
                 this.selectedSlotList.sort(({ selected_timeslot: a }, {selected_timeslot: b }) => a > b ? 1 : a < b ? -1 : 0)
            }
        },
    },
    computed: {
        filterSelectedSlotList(){
            return this.selectedSlotList.filter( slot => !!slot.selected_timeslot)
        }
    },
}
</script>

<style scoped>
.save-slot-btn {
    padding: 10px 20px;
    width: 80%;
    border: none;
    background-color: #029e20;
    border-radius: 5px;
    color: white;
    display: block;
    margin: auto;

}

.save-slot-btn:hover {
    opacity: 0.8;
}

.slot-list ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    flex-flow: wrap;
    gap: 5px;
    align-items: center;
}

.selected-slot-list ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    flex-flow: wrap;
    gap: 7px;
    align-items: center;
    color: rgb(41, 63, 81);
}

.selected-slot-list ul li {
    border: 1px solid rgb(41, 63, 81);
    padding: 5px 15px;
    border-radius: 5px;

}

.slot-list ul li {
    color: #029e02;
    padding: 5px 15px;
    border: 1px solid #029e02;
    border-radius: 3px;
    margin-bottom: 5px;
}

.slot-list ul li:hover {
    cursor: pointer;
}

.slot-delete {
    color: red;
}

.slot-delete:hover {
    cursor: pointer;
}
</style>