import {settings} from "../../../plugins/settings";

function getEmployeeServicePrice (store, providerId, serviceId) {
    let employeeService = store.getters['entities/getEmployeeService'](providerId, serviceId)
    let price = employeeService.price
    if (employeeService.customPricing && employeeService.customPricing.enabled) {
        price = employeeService.customPricing.durations[store.getters['booking/getDuration']].price
    }
    return price
}

function sortForEmployeeSelection (store, employeesIds, serviceId) {
    switch (settings.appointments.employeeSelection) {
        case 'roundRobin': {
            let lastBookedProviderId = store.getters['booking/getLastBookedProviderId']
            employeesIds = employeesIds.map(e => parseInt(e)).sort((a,b) => a-b)
            for (let employeeId of employeesIds) {
                if (parseInt(employeesIds[0]) > parseInt(lastBookedProviderId)) {
                    break
                }
                employeesIds.push(employeesIds.shift())

            }
            return employeesIds
        }
        case 'lowestPrice':
            return employeesIds.sort((emp1, emp2) => {
                let price1 = getEmployeeServicePrice(store, emp1, serviceId)
                let price2 = getEmployeeServicePrice(store, emp2, serviceId)
                if (price1 < price2) {
                    return -1
                } else if (price1 === price2) {
                    return emp1 < emp2 ? -1 : 1
                } else {
                    return 1
                }
            })
        case 'highestPrice':
            return employeesIds.sort((emp1, emp2) => {
                let price1 = getEmployeeServicePrice(store, emp1, serviceId)
                let price2 = getEmployeeServicePrice(store, emp2, serviceId)
                if (price1 < price2) {
                    return 1
                } else if (price1 === price2) {
                    return emp1 < emp2 ? -1 : 1
                } else {
                    return -1
                }
            })
        case 'random': default:
            return employeesIds
    }
}

export {
    sortForEmployeeSelection
}