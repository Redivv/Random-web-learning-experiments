import { Component } from '@angular/core';
import {  Task  } from './task';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  taskName: string = '';
  taskDate: string = '';

  editMode: boolean = false;

  config: { [key: string]: string } = null;

  tasks: Task[] = [
    {
      name: "Siłownia",
      deadline: "2020-01-02",
      done: true,
    },
    {
      name: "Nauka Angulara",
      deadline: "2020-01-03",
      done: false,
    },
    {
      name: "Sprzątanie Kuwety",
      deadline: "2020-01-04",
      done: false,
    },
  ];

  constructor() {
    setTimeout(() =>  {
      this.config = {
        title: 'Lista Zadań',
        footer: '© Lista zadań, All rights reserved.',
        date: new Date().toDateString(),
      };
    },500);
    this.sortTasks();
  }

  clearList(){
    this.tasks = [];
  }

  createTask(){
    const task: Task ={
      name: this.taskName,
      deadline: this.taskDate,
      done: false
    }
    this.tasks.push(task);

    this.taskName = this.taskDate = "";
    this.sortTasks();
  }

  switchEditMode(){
    this.editMode = !this.editMode;
  }

  deleteTask(task: Task){
    this.tasks = this.tasks.filter(e => e !== task);
    this.sortTasks();
  }
  
  checkTask(task: Task){
    task.done = true;
    this.sortTasks();
  }

  private sortTasks(){
    this.tasks = this.tasks.sort((a: Task, b: Task) =>
      a.done === b.done ? 0 : a.done ? 1 : -1
    );
  }
  
}
