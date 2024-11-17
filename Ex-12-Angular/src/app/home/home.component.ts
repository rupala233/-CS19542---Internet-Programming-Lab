// home.component.ts
import { Component, OnInit } from '@angular/core';
import { SharedService } from '../shared.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  contactInfo = {
    name: '',
    email: '',
    age: '',
    city: ''
  };

  constructor(private sharedService: SharedService) { }

  ngOnInit(): void {
    this.contactInfo = this.sharedService.getContactData();  // Retrieve data from the shared service
  }
}
