// Frontend components
import All from './components/All.vue'
import Active from './components/Active.vue'
import Completed from './components/Completed.vue'

export const routes = [
    {
        path:'/',
        component:All
    },
    {
        path:'/all',
        component:All
    },
    {
        path:'/active',
        component:Active
    },
    {
        path:'/completed',
        component:Completed
    }
];