// contact.component.ts
import { Component } from '@angular/core';
import { SharedService } from '../shared.service';  // Import the shared service

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent {
  contactInfo = {
    name: '',
    email: '',
    age: '',
    city: ''
  };

  constructor(private sharedService: SharedService) { }

  // Submit form data to the service
  onSubmit() {
    this.sharedService.updateContactData(this.contactInfo);
  }
}
