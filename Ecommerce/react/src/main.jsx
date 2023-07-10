import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './app'
// import App from '../src/index';
// import Home from './container/home';
// import Login from './container/login';
// import { createBrowserRouter,RouterProvider,BrowserRouter } from 'react-router-dom';

// const router=createBrowserRouter([
//     {
//     path:"/",
//     element:<Home/>,
//     },
//     {
//         path:"/login",
//         element:<Login/>,
//         }
// ])
ReactDOM.createRoot(document.getElementById('root')).render(
//  <RouterProvider router={router}/>
// <BrowserRouter><App/></BrowserRouter>
<App/>

);

