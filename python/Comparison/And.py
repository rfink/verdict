'''

'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class And(CompareAbstract):
	
	
	def compare(self):
		
		if (self.contextVar and self.configVar):
			
			return True
		
		return False
