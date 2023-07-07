// const url = "https://mamcollegejammu.in/";
// import fs from 'fs';

let Url_set = new Set();
import {filterWord,filterLinks,keywordRead,sendRequest,writeFile,appendURL,readFile,sendNextURL, ResumeFile,chkDir, countDepthFile} from './sendRequest.js';
let i=1;
export const crawlWebPage=(id)=>{
  let data;
  ResumeFile(`s_${id}/Resume.txt`)
  .then(result=>{
    if(result=="next") startCrawler(url,1,id,0)
    else{
      data=JSON.parse(result);
      ResumeFile(`s_${id}/visited_links.txt`)
      .then(result=>{
        if(result=="next") console.log("Empty file visited_links");
        else{
          result = result.split("\n");
          Url_set = new Set(result);
          console.log(
            `Current file scanning: depth${data.depth}/data${data.FileNo}.txt \nLast File created: depth${data.depth+1}/data${data.newFile}.txt \nResuming Crawling Process...`
          );

          i=0;
           keywordRead(`s_${id}/keyword.json`)
          levelCrawling(data.FileNo,data.newFile,id,data.depth,data.linkIndex)
          // next_file,parent,id,depth
        }
      })
    }
  })
  .catch(e=>{
    console.log(e.message);
    // startCrawler(url,1,id,0);
  })
}

export const startCrawler=(url,parent,id,depth)=>{
  return new Promise((resolve,reject)=>{
    chkDir(`s_${id}`,depth)
    .then(()=>sendRequest(url))
    .then(body=>{
      writeFile(`s_${id}/depth${depth}/html/data${parent}.html`,body)
      const arr= filterLinks(body,url,id,depth)
       writeFile(`s_${id}/depth${depth}/data/data${parent}.txt`,`${JSON.stringify(arr)}`);
       return body;
    })
    .then(body=>{
      // console.log('arr ',arr);
      return filterWord(body,url,depth,parent)
    })
    .then((obj)=>{ 
      // console.log('obj ',obj)
      Url_set.add(url);
      return writeFile(`s_${id}/keyword.json`,JSON.stringify(obj))
    })
    .then(()=>{
      appendURL(url,id);
      if(i==1){
        levelCrawling(1,0,id,depth,-1);
        i=0;
      }
      return resolve();
    })
    .catch(error=>{
      console.log('start ',error);
      if(error.code=='ENOTFOUND')
        console.log("Invalid URL!!");
      else if(error.code=='ERR_TLS_CERT_ALTNAME_INVALID')
        console.log("Access Denied!!");
      else if(error.code=='ECONNREFUSED')
        console.log("Connect Refused!!");
      else if(error.code=='ETIMEDOUT')
        console.log("Time Out!!");
      else
      if(error==null)
        console.log('Request Failed!!');
      else
        console.log(error);
        return resolve();
    })
  })

}

export const levelCrawling=(next_file,parent,id,depth,linkIndex)=>{
  countDepthFile(`s_${id}/depth${depth}/data`)
  .then(()=>readFile(next_file,id,depth)
  )
  .then(val=>{
    sendNextURL(val,next_file,parent,Url_set,id,depth,linkIndex);
  })  
  .catch(error=>{
    if(error.code=='ETIMEDOUT')
        console.log("Time Out!!");
      else if(error.code=='ECONNREFUSED')
        console.log("Connection Refused!!")
      else 
        console.log("Invalid URL!!",error.message);
    levelCrawling(++next_file,++parent,id,linkIndex);
  })
}

