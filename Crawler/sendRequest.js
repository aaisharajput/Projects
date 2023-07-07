import fs from 'fs';
import request from 'request';
import {startCrawler,crawlWebPage,levelCrawling} from "./stream_test.js";

let max_depth=1;
let url_type;
export const EXE_crawl=(url)=>{
  let obj;
  url_type='E';
  // max_depth=max;
  request(url,(err,response,body)=>{
    if(!err && response.statusCode === 200){
      obj=JSON.parse(body);
      console.log("session id: ",obj.data);

      setTimeout(()=>{
        // startCrawler(url,parent,id,depth)
        startCrawler(`http://127.0.0.1:8000/seed_session?sid=${obj.data}&depth=0`,1,obj.data,0);
        
      },10000)
    } 
    else{
      console.log("error occured!! ",err.message);
    }
  })

}

export const General_crawl=(url)=>{
  // max_depth=max;
  url_type='G';
  let id=Date.now();
  console.log("session id: ",id);
  startCrawler(url,1,id,0);
}

export const Resume_process=(id)=>{
  // max_depth=max;
  url_type='G';
  crawlWebPage(id);
}

export const EXE_Resume_process=(id)=>{
  // max_depth=max;
  url_type='E';
  crawlWebPage(id);
}

export const sendRequest = (url) => {
  return new Promise((resolve, reject) => {
    request(url, (error, response, body) => {
      if (!error && response.statusCode === 200) {
        return resolve(body);
      } else {
        return reject(error);
      }
    });
  });
};

export const chkDir=(dirname,depth)=>{
  return new Promise((resolve,reject)=>{
    if (!fs.existsSync(dirname)) {
      fs.mkdirSync(dirname);
      fs.mkdirSync(`${dirname}/depth${depth}`);
      fs.mkdirSync(`${dirname}/depth${depth}/data`);
      fs.mkdirSync(`${dirname}/depth${depth}/html`);
    }else{
      if (!fs.existsSync(`${dirname}/depth${depth}`)) {
        fs.mkdirSync(`${dirname}/depth${depth}`);
        fs.mkdirSync(`${dirname}/depth${depth}/data`);
        fs.mkdirSync(`${dirname}/depth${depth}/html`);
      }
    }
      return resolve();
  })
  }

let total_file=0;
export const countDepthFile=(dirname)=>{
  return new Promise((resolve,reject)=>{
    total_file = fs.readdirSync(dirname).length;
    console.log("dir file count: ",total_file);
    return resolve(total_file);
  })
}

export const filterLinks = (body,url,id,depth) => {
  if(url_type=='G'){
    return filterGEN(body,url);
  }else{
    return filterEXE(body,url,id,depth);
  }
}

export const filterEXE=(body,url,id,depth)=>{
  const regex = /href="([^"]*)"/g;
    const matches = body.match(regex);
    const arr = [];
    if (matches) {
      const links = matches.map( 
        (match) => match.match(/href=(["'])(.*?)\1/)[2]
      );
      links.forEach((l, i) => {
        arr[i] = new URL(l, url).href+`?sid=${id}&depth=${depth+1}`;
      });
    }
    return arr;
}

export const filterGEN=(body,url)=>{
  const regex = /<a\s+href=(["'])(.*?)\1/g;
    const matches = body.match(regex);
    const arr = [];
    if (matches) {
      const links = matches.map(
        (match) => match.match(/href=(["'])(.*?)\1/)[2]
      );
      links.forEach((l, i) => {
        arr[i] = new URL(l, url).href;
      });
    }
    return arr;
}

let keyword={};
export const filterWord=(body,url,d,no)=>{ 
  const regex = /<[^>]*>/g;
  const title=/\<Title\>(.+)\<\/Title\>/ig;
  const meta=/<meta[^>]*?name=["']([description^"']+)["'][^>]*?content=["']([^"']+)["'][^>]*?>/ig;
  const Body=/<body[^\>]*>([\s\S]*)<\/body>/igm;
  const stop_word=['is','are','now','and','for','tutorial','...',',','beginners','offers','too','many','high','off','or','not','none','contact','about','us','teaching','at','understand','basic','steps','Facilities','Notifications','Notification','fee','on','in','add','Departments','learn','more','learning','they','how','to','use','with','what','where','a','it','was','their','who','why','whom','which','that','etc','because','so','i','am','you','your','yours','some','same'];
  const pattern=new RegExp(`\\b(${stop_word.join('|')})\\b`, 'gi');
  let b=body.match(Body);
  let matches_title = body.match(title);
  let metaTag=body.match(meta);
  let titleKey,HKey,metaKey;

  if(metaTag!=null) {
    const description = metaTag.map(
      (match) => match.match(/content=(["'])(.*?)\1/)[2]
    );
    description.forEach((str)=>{
      str=str.replace(regex,' ').replace(pattern,'');
      metaKey=str.split(' ');
    })
    filterMetaTag(metaKey,url);
  }

  if(matches_title!=null){
    matches_title[0]=matches_title[0].replace(regex,'').replace(pattern,'');
    matches_title.forEach((str)=>{
      titleKey=str.split(' ');
    })

    filterTitle(titleKey,url);
  }

  
for(let i=1;i<=5;i++){
    const H=new RegExp(`<h${i}[^>]*>(.+)\<\/h${i}\>`,'gi');
  let matches_h = body.match(H);
  if(matches_h!=null){
    matches_h.forEach((str)=>{
      str=str.replace(regex,' ').replace(pattern,'');
      HKey=str.split(' ');
    })
    filterHeading(HKey,url,i);
  }
}
  
  if(b!=null){
    filterContent(b[0],url,d,no,pattern)
  }
  return keyword;
}

export const filterHeading=(headingKey,url,i)=>{
  headingKey.forEach((l)=>{
    if(!(l.match(/\W/)) && l!='' && !(l.match(/\d/))){
      if(keyword[l]){
        if(keyword[l][`h${i}`]){
          if(keyword[l][`h${i}`].url!=undefined)
            keyword[l][`h${i}`].url+=1;
          else{
            keyword[l][`h${i}`][url]=1;
          }

        }else{
          keyword[l][`h${i}`]={};
          keyword[l][`h${i}`][url]=1;
        }
       
      }else{
        keyword[l]={};
        keyword[l][`h${i}`]={};
        keyword[l][`h${i}`][url]=1;
      }  
    }
  })
}

export const filterMetaTag=(metaKey,url)=>{
  metaKey.forEach((l)=>{
    if(!(l.match(/\W/)) && l!='' && !(l.match(/\d/))){
      if(keyword[l]){
        if(keyword[l].meta){
          if(!(keyword[l].meta.includes(url)))
          keyword[l].meta.push(url);
        }else{
          keyword[l].meta=[];
          keyword[l].meta.push(url);
        }
      }else{
        keyword[l]={};
        keyword[l].meta=[];
        keyword[l].meta.push(url);
      }  
    }
  })
}

export const filterTitle=(titleKey,url)=>{
  titleKey.forEach((l)=>{
    if(!(l.match(/\W/)) && l!='' && !(l.match(/\d/))){
      if(keyword[l]){
        if(keyword[l].title){
          if(!(keyword[l].title.includes(url)))
          keyword[l].title.push(url);
        }else{
          keyword[l].title=[];
          keyword[l].title.push(url);
        }
      }else{
        keyword[l]={};
        keyword[l].title=[];
        keyword[l].title.push(url);
      }  
    }
  })
}

export const filterContent=(body,url,d,no,pattern)=>{
  const regex = /<[^>]*>/g;
 let matches = body.replace(regex,'').replace(pattern,'');
    matches=matches.split(' ');

        matches.forEach((l)=>{
          if(!(l.match(/\W/)) && l!='' && !(l.match(/\d/))){
            if(keyword[l]){
              if(keyword[l].content){
                if(keyword[l].content[`depth${d}/html/data${no}`])
                  keyword[l].content[`depth${d}/html/data${no}`]+=1;
                else{
                  keyword[l].content[`depth${d}/html/data${no}`]=1;
                }

              }else{
                keyword[l].content={};
                keyword[l].content[`depth${d}/html/data${no}`]=1;
              }

              if(keyword[l].url){
                if(!(keyword[l].url.includes(url)))
                keyword[l].url.push(url);
              }else{
                keyword[l].url=[];
                keyword[l].url.push(url);
              }

            }else{
              keyword[l]={};
              keyword[l].content={};
              keyword[l].url=[];
              keyword[l].url.push(url);
              keyword[l].content[`depth${d}/html/data${no}`]=1;
            }  
          }
        })
    
}

export const writeFile=(filename,content)=>{
    return new Promise((resolve, reject) => {
        const WriteStream = fs.createWriteStream(filename);

        WriteStream.on("finish", () => {return resolve(filename);})
        WriteStream.on("error", (error) => {return reject(error);});
        WriteStream.write(content);
        WriteStream.end();
    })
 }

export const appendURL=(url,id)=>{
  return new Promise((resolve,reject)=>{
    fs.appendFile(`s_${id}/visited_links.txt`, `${url}\n`,(err)=>{
      if(err) reject(err);
      else resolve();
    });
  })
}

export const readFile=(next_file,id,depth)=>{
  return new Promise((resolve, reject) => {
    fs.readFile(`s_${id}/depth${depth}/data/data${next_file}.txt`, "utf-8", (err, data) => {
      if(err) return reject(err);
      else{
        console.log(`File name: s_${id}/depth${depth}/data${next_file}.txt`);
        let arr = JSON.parse(data);
        return resolve(arr);
      }
    })
  })
}

export const keywordRead= (filename)=>{
  return new Promise(async(resolve,reject)=>{
    let data=await ResumeFile(filename);
    if(data=="next"){return reject("Empty file keyword");
    }
    else{
      data=JSON.parse(data);
      keyword=data;
      return resolve(data);
    }
  })
}

export const ResumeFile=(filename)=>{
  return new Promise((resolve, reject) => {
    fs.readFile(filename, "utf-8", (err, data) => {
      if(err) return reject(err);
      else{
        if (data.length == 0) {
          return resolve("next");
        }else{
          return resolve(data);
        }
      }
    })
  })
}

export const sendNextURL=(arr,next_file,parent,Url_set,id,depth,linkIndex)=>{
  let obj = {};
  let i=linkIndex,link;
  let interval=  setInterval(async () => {
      i++;
      link=arr[i];
      if (!Url_set.has(link)) {
        console.log("next link: ", link);
        obj = { FileNo: next_file,linkIndex: i, lastURL: link, newFile: parent+1, depth:depth};
        console.log(next_file,parent+1,id,depth,i,arr.length)
        try{
          await writeResume(id,obj)
          await startCrawler(link,++parent,id,depth+1)
          if (i + 1 == arr.length) {
            if(total_file==next_file){
              if((depth+1)!=max_depth){
                // next_file,parent,id,depth
                clearInterval(interval);
                levelCrawling(1,0,id,++depth,-1);
              }else{
                clearInterval(interval);
                if(url_type=='E'){
                  request(`http://127.0.0.1:8000/stop_session?sid=${id}`,(err,res,body)=>{
                    console.log("Crawling End!!: ",body);
                  })
                }else{
                  console.log("Crawling End!!");
                }
                  
              }
            }
            else
              levelCrawling(++next_file,++parent,id,depth,-1);
          }
        }catch(err){
          console.log("error in resume: ",err);
        }
      } 
    },10000);
}

export const writeResume=(id,obj)=>{
  return new Promise((resolve,reject)=>{
    fs.writeFile(`s_${id}/Resume.txt`, JSON.stringify(obj), (err) => {
      if(err) return reject(err);
      else {
        return resolve();
      }
    });
  })
}

// export const sendNextURL=(arr,next_file,parent,Url_set)=>{
//     let obj = {};
//     arr.forEach((link, i) => {
//       setTimeout(() => {
//         if (!Url_set.has(link)) {
//           console.log("next link: ", link);
//           obj = { File_no: next_file, lastURL: link, newFile: parent+1};
//           fs.writeFile("Resume.txt", JSON.stringify(obj), (err) => {
//             if(err) console.log("error: resume file write",err);
//             else startCrawler(link,++parent);
//           });
//         }
//         if (i + 1 == arr.length) {
//           levelCrawling(++next_file,++parent);
//         }
//       }, i * 2000);
//     });
// }

// export const readFile=(next_file)=>{
//   return new Promise((resolve, reject) => {
//     // if(fs.existsSync(`data/data${next_file}.txt`)){
//       let data='';
//       const ReadStream = fs.createReadStream(`data/data${next_file}.txt`);

//       console.log(`File name: data${next_file}.txt`);
//       ReadStream.on("error", (error) => {return reject(error);});
//       ReadStream.on("data", (chunk) => {data+=chunk;console.log("chunk",chunk);})
//       ReadStream.on("end", () => {return resolve(data);});
//     // }else{
//     //   return reject(new Error("failed"));
//     // }
//   })
// }