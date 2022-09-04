import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  public BASE_URL = "http://127.0.0.1:8000/api/";
  // public BASE_URL = "https://dev.gipirandlabongo.com/public/api/";
  id:any;
  service_name:any;
  deviceToken:any;
  date:any;
  total: any;
  qty: any;
  latt:number;
  long:number;
  constructor(private http:HttpClient) { }

  getData(url){
    return this.http.get(this.BASE_URL + url);
  }

  postData(url,data){
    return this.http.post(this.BASE_URL + url , data)
  }

  getDataWithToken(url){
    let headers = new HttpHeaders({
      Authorization: "Bearer " + localStorage.getItem("token"),
    });
    return this.http.get(this.BASE_URL + url, {headers:headers});
  }

  postDataWithToken(url, data){
    let headers = new HttpHeaders({
      Authorization: "Bearer " + localStorage.getItem("token"),
    });
    return this.http.post(this.BASE_URL + url , data, {headers:headers})
  }
}
