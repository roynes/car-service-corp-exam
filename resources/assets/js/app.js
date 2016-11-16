
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Use `Laravel` like validation for Vue
 */

Vue.use(require('vee-validate'));

const app = new Vue({
    el: '#app',
    data: {
        feeTotal: 0,
        feeTotalWitVat: 0,
        valueAddedTaxRate: 0.25,
        removedProducts: [],
        products: []
    },
    mounted: function() {
        this.$http.get('products').then(
            (sucessResp) => {
                this.products = JSON.parse(sucessResp.body);
            },
            (errResp) => {
                this.products = [
                    {
                        name: 'HD Quad TV',
                        price: 20000,
                        quantity: 0
                    },
                    {
                        name: 'iPhone 7s',
                        price: 10000,
                        quantity: 0
                    },
                    {
                        name: 'Samsung Galaxy S7',
                        price: 30000,
                        quantity: 0
                    }
                ];
            }
        );
    },
    methods: {
        computeTotalFee: function(event, product) {
            var tempFee = 0;

            if(parseInt(event.target.value) >= 0)
                product.quantity = parseInt(event.target.value);
            else
                event.target.value = 0;

            product.total = product.quantity * product.price;

            for(i = 0; i < this.products.length; i++)
            {
                tempFee += ( this.products[i].price * this.products[i].quantity );
            }

            this.feeTotal = tempFee;
            tempFee = tempFee * this.valueAddedTaxRate;
            this.feeTotalWitVat = this.feeTotal + tempFee;
        },
        reComputeTotalFee: function(index, products) {
            var itemElem = document.getElementById('item-'+ index);

            itemElem.parentNode.removeChild(itemElem);

            this.removedProducts.push(this.products[index]);
            this.feeTotal -= (this.products[index].price * this.products[index].quantity);
            this.feeTotalWitVat = (this.feeTotal * this.valueAddedTaxRate) + this.feeTotal;
        },
        beforeSubmit: function(e) {
            this.$validator.validateAll();
            if(!this.errors.any())
                alert('Test Done!');
        }
    }
});
