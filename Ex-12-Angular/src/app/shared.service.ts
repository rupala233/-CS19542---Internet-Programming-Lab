// shared.service.ts
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class SharedService {
  private contactData = {
    name: '',
    email: '',
    age: '',
    city: ''
  };

  // Method to update the contact data
  updateContactData(data: { name: string, email: string, age: string, city: string }) {
    this.contactData = data;
  }

  // Method to retrieve the contact data
  getContactData() {
    return this.contactData;
  }
}
