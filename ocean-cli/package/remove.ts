import { JsonDB, Config } from 'node-json-db'
import type { Package } from '~/types/package'

const db = new JsonDB(new Config('./database/json/packages', true, false, '/'))

export const removePackage = async function(){
    return await db.getObject<Package>('/')
}