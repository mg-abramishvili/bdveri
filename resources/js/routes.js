import Home from './components/front/home/Home.vue';
import Catalog from './components/front/catalog/Catalog.vue';
import Products from './components/admin/products/ProductsAll.vue';
import ProductCreate from './components/admin/products/ProductCreate.vue';
import ProductEdit from './components/admin/products/ProductEdit.vue';
import TempFiles from './components/admin/temp_files/TempFiles.vue';

export const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/catalog',
        name: 'Catalog',
        component: Catalog
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
        path: '/admin/products/:id/edit',
        name: 'ProductEdit',
        component: ProductEdit
    },
    {
        path: '/admin/temp_files',
        name: 'TempFiles',
        component: TempFiles
    },
];