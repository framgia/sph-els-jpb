import Counter from "./Counter";
import Header from "./Header";
import Footer from "./Footer";

export { Counter, Header, Footer };

/** Quick Guide on how this thing works.
 * Import the folder of your Component here, then add it in the export section.
 *  
[ 
  import Footer from "./Header"; and import Header from "./Header"; 
  basically says that... 
  
  Import the folder "./Header", "./Header", and name it Header, and Footer or what ever you want to call your Components.
  It was like a key value pair or like a variable named after the import with the value from, from.
]
 * 
[ 
  export { Header, Footer }; basically says that... 

  From the "./Header", "./Footer" folder, export the imported file named { Header, Footer }.
  When using the * method in importing, all of the Components that are exported in this section are accessible from any page.
] 
 * This method can help us in reducing the length of our codes whenever we import them into any page.
 * 
 * [+] Importing to any page [+]
 * When you want to import your Components into any page, use this importing method.
 *  
[ 
  import * as Component from "./ComponentFolderName/"; basically says that... 

  Import ALL files and turn them into an object, then create a variable named Component.
  So, whenever you want to call one of your component, just type "<Component".
  Then use dot notation to get the value you're looking for "<Component.Header />".
  
  The from path should point to the Component path you want to use, with the index of that folder as the default value.
] 
 * You dont need to add /index.js, JavaScript is smart enough to know that you're importing the index.
 * This index contains all of your Component, so make sure to add your Component paths here before importing them to other pages.
 * 
**/
