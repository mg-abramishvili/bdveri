import Home from './components/front/home/Home.vue';
import Products from './components/admin/products/ProductsAll.vue';
import ProductCreate from './components/admin/products/ProductCreate.vue';
import TempFiles from './components/admin/temp_files/TempFiles.vue';

export const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/admin/products',
        name: 'Products',
        component: Products
    },
    {
        path: '/admin/products/create',
        name: 'ProductCreate',
        component: ProductCreate
    },
    {
        path: '/admin/temp_files',
        name: 'TempFiles',
        component: TempFiles
    },
];