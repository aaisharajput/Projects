import express from "express";
const app = express();
const port = 3000;
// import request from 'request';

// import { crawlWebPage} from "./stream_test.js";
import { EXE_crawl,General_crawl,Resume_process,EXE_Resume_process } from "./sendRequest.js";
// https://www.digitalocean.com/community/tutorials/react-axios-react
// 'http://127.0.0.1:8000/start_session'
var args = process.argv;
if (args == undefined) {
  console.log("URL not defined!!");
} else {
  if (args[2] == "--crawl" && args[3] && args[4]==undefined) {
    console.log(args[2], args[3]);
    General_crawl(args[3]);
  } else if (args[2] == "--resume" && args[3] && args[4]==undefined) {
    console.log(args[2], args[3]);
    Resume_process(args[3]);
  } else if (args[2] == "--EXE" && args[3] == "--crawl" && args[4] && args[5]==undefined) {
    console.log(args[2], args[3],args[4]);
    EXE_crawl(args[4]);
  } else if (args[2] == "--EXE" && args[3] == "--resume" && args[4] && args[5]==undefined) {
    console.log(args[2], args[3], args[4]);
    EXE_Resume_process(args[4]);
  } else {
    console.log("Invalid command");
    console.log("For exe file:\n--EXE --crawl 'URL'\n--EXE resume 'session id'\nFor general\n--crawl 'URL'\n--resume 'session id'");
  }
}

// crawlWebPage(`http://127.0.0.1:8000/seed_session?sid=671089&depth=0`,671089);
app.listen(port,()=>{
  console.log("port no.: ",port);
});


// if (args == undefined) {
//   console.log("URL not defined!!");
// } else {
//   if (args[2] == "--crawl" && args[3] && args[4]=="--depth" && args[5] && args[6]==undefined) {
//     let depth=parseInt(args[5]);
//     console.log(typeof depth,depth);
//     if(depth==NaN)
//       console.log("Invalid Depth");
//     else{
//       console.log(args[3],depth);
//       // General_crawl(args[3],parseInt(args[5]));
//     }
    
//   } else if (args[2] == "--resume" && args[3] && args[4]=="--depth" && args[5] && args[6]==undefined) {
//     console.log(args[3],args[5]);
//     // Resume_process(args[3],parseInt(args[5]));
//   } else if (args[2] == "--EXE" && args[3] == "--crawl" && args[4] && args[5]=="--depth" && args[6] && args[7]==undefined) {
//     console.log(args[4],args[6]);
//     // EXE_crawl(args[4],parseInt(args[6]));
//   } else if (args[2] == "--EXE" && args[3] == "--resume" && args[4] && args[5]=="--depth" && args[6] && args[7]==undefined) {
//     console.log(args[4],args[6]);
//     // Resume_process(args[4],parseInt(args[6]));
//   } else {
//     console.log("Invalid command");
//     console.log("For exe file:\n--EXE --crawl 'URL' --depth 'depth'\n--EXE --resume 'session id' --depth 'depth'\n\nFor general\n--crawl 'URL' --depth 'depth'\n--resume 'session id' --depth 'depth'");
//   }
// }