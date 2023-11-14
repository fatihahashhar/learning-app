<!-- BOC FOR V-FOR WITHOUT KEY -->
<!-- <template> 
     <h1 v-for="component in components"> 
         {{component}} 
     </h1> 
 </template>

<script>
export default{
    data(){
        return {
            components: ['1', '2', '3', '4', '5', '6']
        }
    }
}
</script> -->
<!-- EOC FOR V-FOR WITHOUT KEY -->

<!-- BOC FOR V-FOR WITH KEY -->
<!-- <template>
    <div v-for="(productClass, index) in productClasses" :key="index" class="row">
        <div class="pe-4">
            {{ productClass.name }}
        </div>
        <div class="pe-4">
            {{ productClass.price.toLocaleString() }}
        </div>
        <div class="pe-4">
            {{ productClass.seatsAvailable }}
        </div>
        <button v-if="productClass.earlyBird" class="button">Book early bird!</button>
        <button v-else class="button">Book now!</button>

        <div v-show="productClass.seatsAvailable < 10">Almost sold out!</div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            productName: 'Book a Cruise to the Moon',
            productDescription: 'Cruise to the moon in our luxurious shuttle. Watch the astronauts working outside the International Space Station.',
            productClasses: [
                {
                    name: 'Coach',
                    price: 125000,
                    seatsAvailable: 20,
                    earlyBird: true
                },
                {
                    name: 'Business',
                    price: 275000,
                    seatsAvailable: 6,
                    earlyBird: true
                },
                {
                    name: 'First',
                    price: 430000,
                    seatsAvailable: 2,
                    earlyBird: false
                }
            ]
        }
    },
}
</script>

<style scoped>
.row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    vertical-align: middle;
    margin: 5px;
}
</style> -->
<!-- EOC FOR V-FOR WITH KEY -->

<!-- EOC FOR V-MODEL -->
<template>
    <div>
        <input type="text" v-model="name" />
    </div>
    <div>
        <input type="checkbox" v-model="active" /> Is active
    </div>
    <div>
        <input type="checkbox" v-model="benefitsSelected" true-value="yes" false-value="no"> Benefits selected: {{
            benefitsSelected }}
    </div>
    <div class="mb-4">
        <select v-model="statusIndex">
            <!-- Create a message to select one -->
            <option disabled value="">Please select one</option>
            <!-- Use v-for to create the list of options -->
            <option v-for="(status, index) in statusLists" :value="index">
                {{ status }}
            </option>
        </select>
    </div>
    <div>
        <!-- TODO: Add booking form -->
        <form v-show="!booking.completed">
            <div class="row">
                <label for="product-cabin">Select class:</label>
                <select id="product-cabin" v-model="booking.cabinIndex">
                    <option v-for="(cabin, index) in product.cabins" :value="index">
                        {{ cabin.name }} $ {{ cabin.price.toLocaleString('en-US') }}
                    </option>
                </select>
            </div>
            <div class="row">
                <label for="notes">Notes:</label>
                <textarea v-model="booking.notes" rows="3"></textarea>
            </div>
            <div class="row">
                <!-- TODO: Add button later -->
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: 'Cheryl',
            status: -1,
            active: true,
            benefitsSelected: 'yes',
            statusLists: [
                'full-time',
                'part-time',
                'contractor'
            ],

            product: {
                cabins: [
                    { name: 'Coach', price: 125000 },
                    { name: 'Business', price: 275000 },
                    { name: 'First', price: 430000 },
                ]
            },
            booking: {
                cabinIndex: 0,
                notes: '',
                completed: false
            }
        }
    }
}
</script>
<!-- EOC FOR V-MODEL -->



