import dayjs from 'dayjs'
import { useStorage } from '@vueuse/core'

type VisitTrackerValues = {
    lastVisitDate: string | null;
    newVisitDate: string | null;
};

export const useVisitTracker = (): VisitTrackerValues => {
    const lastVisitDate = useStorage<string | null>('lastVisitDate', null)
    const newVisitDate = useStorage<string | null>('newVisitDate', null)
    const GRACE_PERIOD = 5

    // If the lastVisitDate is empty, set the current time
    if (!lastVisitDate.value) {
        lastVisitDate.value = new Date().toISOString()
        newVisitDate.value = null
    }
    // If newVisitDate is empty, set it to the current time
    // so that on the next visit, we have something to compare the GRACE_PERIOD minutes difference with
    else if (!newVisitDate.value) {
        newVisitDate.value = new Date().toISOString()
    }
    // If the difference between the lastVisitDate and newVisitDate is more than GRACE_PERIOD minutes,
    // set the lastVisitDate to the current time and newVisitDate to null
    else if (dayjs().diff(newVisitDate.value, 'minute') > GRACE_PERIOD) {
        lastVisitDate.value = new Date().toISOString()
        newVisitDate.value = null
    }

    return {
        lastVisitDate: lastVisitDate.value,
        newVisitDate: newVisitDate.value,
    }
}