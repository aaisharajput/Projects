// // import Todo from './todo';
import { Routes, Route, BrowserRouter } from 'react-router-dom';
import Header from './component/header';
import Home from './container/home';
import Login from './container/login';
import SignUp from './container/signup';
import Logout from './container/logout';
import Forgot from './component/verify_first';
import ChangePswd from './component/change_pswd';
import UserCart from './component/user_cart';
import { PrivateComponent, PublicComponent } from './component/private';
import { useEffect } from 'react';
// import { useEffect, useState } from 'react';


// import { checkAuth } from '../api/endpoints';

// export default function App(){
//   const [isLoggedIn,setIsLoggedIn]=useState(true);
//   const [isCheckingAuth,setIsCheckingAuth]=useState(true);

//   useEffect(function(){
//     checkIfUserLoggedIn(); 
//   },[]) 

//   async function checkIfUserLoggedIn(){
//     try{
//       const result=await checkAuth();
//       console.log("result ",result);
//       setIsLoggedIn(result===200);
//       setIsCheckingAuth(false);
//     }catch(e){
//       console.log(e);
//       setIsCheckingAuth(false);
//     }
//   }

//   function onLogin(){
//     setIsLoggedIn(true);
//     console.log(isLoggedIn)
// }
//     return (
//       <>
//       {
//         isCheckingAuth?<div>Loding...</div>:
//         isLoggedIn?<Home/>:<Login onLogin={onLogin}/>
//       }
//       </>
//     )
//   }

export default function App() {

	return (
		<BrowserRouter>
			<Header />
			<Routes>
				<Route path='/' element={<Home />}></Route>

				<Route element={<PrivateComponent />}>
					{/* <Route path='/' element={<Home/>}></Route> */}
					<Route path='/user/change_password' element={<ChangePswd />}></Route>
					<Route path='/user/logout' element={<Logout />}></Route>
					<Route path='/user/cart' element={<UserCart />}></Route>
				</Route>

				<Route element={<PublicComponent />}>
					<Route path='/login' element={<Login />}></Route>
					<Route path='/signup' element={<SignUp />}></Route>
					<Route path='/forgot_password' element={<Forgot />}></Route>
				</Route>

			</Routes>
		</BrowserRouter>
	)
}