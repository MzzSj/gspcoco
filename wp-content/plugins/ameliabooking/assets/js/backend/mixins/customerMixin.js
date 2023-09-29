export default {

  data: () => ({
    searchCounter: 0,
    loadingCustomers: false,
    searchCustomersTimer: null,
    searchedCustomers: [],
    dialogCustomer: false
  }),

  methods: {
    getInitCustomerObject () {
      return {
        id: 0,
        firstName: '',
        lastName: '',
        externalId: '',
        phone: '',
        countryPhoneIso: null,
        email: '',
        gender: '',
        birthday: null,
        note: '',
        status: 'visible',
        type: 'customer',
        countPendingAppointments: 0
      }
    },

    setInitialCustomers () {
      if (this.$root.settings.role !== 'customer') {
        this.searchCustomers(
          '',
          () => {
            let entitiesCustomers = this.options && 'entities' in this.options && 'customers' in this.options.entities
              ? this.options.entities.customers : []

            let customersIds = entitiesCustomers.map(customer => parseInt(customer.id))

            let customers = entitiesCustomers

            this.searchedCustomers.forEach((customer) => {
              if (customersIds.indexOf(parseInt(customer.id)) === -1) {
                customersIds.push(customer.id)
                customers.push(customer)
              }
            })

            this.$nextTick(() => {
              this.options.entities.customers = Object.values(customers.sort((a, b) => (a.firstName.toLowerCase() > b.firstName.toLowerCase()) ? 1 : -1))
            })
          }
        )
      }
    },

    searchCustomers (query, callback) {
      clearTimeout(this.searchCustomersTimer)

      this.loadingCustomers = true
      this.searchCounter++

      this.searchCustomersTimer = setTimeout(() => {
        let lastSearchCounter = this.searchCounter

        this.$http.get(`${this.$root.getAjaxUrl}/users/customers`, {
          params: {search: query, page: 1, limit: this.$root.settings.general.customersFilterLimit, skipCount: 1}
        })
          .then(response => {
            if (lastSearchCounter >= this.searchCounter) {
              this.searchedCustomers = response.data.data.users.sort((a, b) => (a.firstName.toLowerCase() > b.firstName.toLowerCase()) ? 1 : -1)
            }

            this.loadingCustomers = false

            callback()
          })
          .catch(e => {
            this.loadingCustomers = false
          })
      },
      500
      )
    }
  }
}
