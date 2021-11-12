import MainPage from "../components/MainPage";

import ListDepartments from "../components/department/ListDepartments";
import CreateDepartment from "../components/department/CreateDepartment";
import EditDepartment from "../components/department/EditDepartment";

import ListEmployees from "../components/employee/ListEmployees";
import CreateEmployee from "../components/employee/CreateEmployee";
import EditEmployee from "../components/employee/EditEmployee";

export const routes = [
    {
        name: 'main',
        path: '/',
        component: MainPage,
    },
    {
        name: 'department',
        path: '/departments',
        component: ListDepartments,
    },
    {
        name: 'department.create',
        path: '/departments/create',
        component: CreateDepartment
    },
    {
        name: 'department.edit',
        path: '/departments/edit/:id',
        component: EditDepartment
    },
    {
        name: 'employee',
        path: '/employees',
        component: ListEmployees,
    },
    {
        name: 'employee.create',
        path: '/employees/create',
        component: CreateEmployee,
    },
    {
        name: 'employee.edit',
        path: '/employees/edit/:id',
        component: EditEmployee,
    },
];
