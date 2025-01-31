<script>
    class DatePickerManager {
      constructor(elementId, options = {}) {
        this.element = document.getElementById(elementId);
        this.lastValue = "";
        this.datePicker = null;
        this.init(options);
      }
    
      init(customOptions = {}) {
        const defaultOptions = {
          dateFormat: "m/d/Y",
          allowInput: true,
          disableMobile: true,
          onChange: (selectedDates, dateStr) => {
            if (selectedDates.length > 0) {
              this.element.value = dateStr;
              this.lastValue = dateStr;
            }
          }
        };
    
        // Merge default options with custom options
        const options = { ...defaultOptions, ...customOptions };
        
        // Initialize Flatpickr
        this.datePicker = flatpickr(`#${this.element.id}`, options);
        
        // Add input event listener for manual typing
        this.element.addEventListener('input', this.handleInput.bind(this));
        
        // Add keydown listener for better backspace handling
        this.element.addEventListener('keydown', this.handleKeydown.bind(this));
      }
    
      formatWithLeadingZero(num) {
        return num < 10 ? `0${num}` : num.toString();
      }
    
      handleInput(e) {
        let v = e.target.value;
    
        // Handle backspace/delete - allow normal deletion
        if (v.length < this.lastValue.length) {
          this.lastValue = v;
          if (v.length === 0) {
            this.datePicker.clear();
          }
          return;
        }
    
        // Only proceed with formatting if we're adding characters
        if (v.length > this.lastValue.length) {
          // Handle MM/ format
          if (v.match(/^\d{2}$/) !== null) {
            let month = parseInt(v);
            // Preserve the original input if it's a valid month with leading zero
            if (v.startsWith('0') && month >= 1 && month <= 9) {
              v = v + '/';
            } else {
              month = Math.min(Math.max(month, 1), 12); // Ensure month is between 1 and 12
              v = this.formatWithLeadingZero(month) + '/';
            }
          } 
          // Handle MM/DD/ format
          else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
            let parts = v.split('/');
            let month = parseInt(parts[0]);
            let day = parseInt(parts[1]);
            
            // Preserve leading zeros while ensuring valid ranges
            month = Math.min(Math.max(month, 1), 12);
            day = Math.min(Math.max(day, 1), 31);
            v = this.formatWithLeadingZero(month) + '/' + this.formatWithLeadingZero(day) + '/';
          }
          // Handle complete date format MM/DD/YYYY
          else if (v.match(/^\d{2}\/\d{2}\/\d{4}$/) !== null) {
            let parts = v.split('/');
            let month = parseInt(parts[0]);
            let day = parseInt(parts[1]);
            let year = parseInt(parts[2]);
            
            // Ensure valid ranges while preserving leading zeros
            month = Math.min(Math.max(month, 1), 12);
            day = Math.min(Math.max(day, 1), 31);
            
            // Create a date string with leading zeros
            let dateStr = `${this.formatWithLeadingZero(month)}/${this.formatWithLeadingZero(day)}/${year}`;
            let date = new Date(dateStr);
            
            // Only update if it's a valid date
            if (!isNaN(date.getTime())) {
              this.datePicker.setDate(date, false);
            }
          }
          
          e.target.value = v;
          this.lastValue = v;
        }
      }
    
      handleKeydown(e) {
        if (e.key === 'Backspace' || e.key === 'Delete') {
          if (e.target.value.length === 0) {
            this.datePicker.clear();
          }
        }
      }
    
      safelyUpdateValue(value) {
        this.element.value = value;
        this.lastValue = value;
      }
    }
    
    // Example usage:
    const dateInputs = {
      departure: new DatePickerManager('departure_date'),
      return: new DatePickerManager('return_date'),
      departure1: new DatePickerManager('departure_date1'),
      return1: new DatePickerManager('return_date1', {
        onChange: function(selectedDates, dateStr, instance) {
          if (selectedDates.length > 0) {
            // Ensure the dateStr maintains leading zeros
            let parts = dateStr.split('/');
            let formattedDate = `${parts[0].padStart(2, '0')}/${parts[1].padStart(2, '0')}/${parts[2]}`;
            instance._input.value = formattedDate;
            instance.input.lastValue = formattedDate;
          }
        }
      })
    };
    </script>